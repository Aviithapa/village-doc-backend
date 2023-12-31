<?php

namespace App\Services\Doctor;

use App\Mail\AdminCreateUser;
use App\Client\FileUpload\FileUploaderInterface;
use App\Models\Medias;
use App\Models\Role;
use App\Models\User;
use App\Repositories\Doctor\DoctorRepository;
use App\Repositories\Media\MediaRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

/**
 * Class  DoctorCreator
 * @package App\Services\Doctor
 */
class DoctorCreator
{
    /**
     * @var DoctorRepository
     */
    protected $doctorRepository;
    protected $fileUploader;
    protected $mediaRepository;


    /**
     * DoctorGetter constructor.
     * @param DoctorRepository $doctorRepository

     */
    public function __construct(DoctorRepository $doctorRepository,FileUploaderInterface $fileUploader,MediaRepository $mediaRepository)
    {
        $this->doctorRepository = $doctorRepository;
        $this->mediaRepository = $mediaRepository;
        $this->fileUploader = $fileUploader;
    }

    /**
     * Store an doctor
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        try{
            DB::beginTransaction();
            $reference = Str::random(5) . rand(100, 999); 
            $password = bcrypt($reference);
            $data['created_by'] = getAuthUser();
            $doctor =  $this->doctorRepository->store($data);

            $response =  $this->fileUploader->upload($data['image'], "signature");
            $response['type'] = Medias::TYPE_SIGNATURE;
            $response['doctor_id'] = $doctor->id;
            $this->mediaRepository->store($response);

            $doctorArray = [
                'username' => $doctor->first_name,
                'email' => $doctor->email,
                'password' => $password,
                'reference' => $reference,
                'status'    => 'active'
            ];

            $userData = User::create($doctorArray);
            $roleId = Role::where('name','doctor')->pluck('id')->first();
            DB::table('role_user')->insert([
                'role_id' => $roleId,
                'user_id'   => $userData->id
            ]);
            // Mail::to($doctor->email)->send(new AdminCreateUser($userData));
            
            DB::commit();
            return $doctor->refresh();

        }catch(Exception $e){
            DB::rollBack();
            throw $e;
        }
    }
}
