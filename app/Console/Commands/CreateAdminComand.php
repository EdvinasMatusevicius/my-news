<?php

namespace App\Console\Commands;

use App\Admin;
use App\Repositories\AdminRepository;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class CreateAdminComand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new admin';

    protected $adminRepository;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(AdminRepository $adminRepository)
    {
        parent::__construct();

        $this->adminRepository = $adminRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try{
            $data = [
                "email" => $this->enterEmail(),
                "password" => $this->enterPassword(),
            ];

            $this->adminRepository->createNew($data);
            $this->info('Admin created');
        }catch(Exception $exception){
            $this->error($exception->getMessage());
        }
    }

    private function enterEmail():string
    {
        $email = $this->ask('Enter admin email');
        $validator = Validator::make([
            'email'=>$email,
        ],[
            'email'=>'required|email|unique:admins'
        ]);

        if($validator->fails()){
            $this->error($validator->errors()->first('email'));

            return $this->enterEmail();
        }
        return $email;
    }
    private function enterPassword():string
    {
        $password = $this->secret('Enter admin password');
        $passwordConfirm = $this->secret('Repeat admin password');

        $validator = Validator::make([
            'password'=>$password,
            'password_confirmation'=>$passwordConfirm
        ],[
            'password'=>'required|min:8|confirmed'

        ]);
        if($validator->fails()){
            $this->error($validator->errors()->first('password'));

            return $this->enterPassword();
        }
        return bcrypt($password);
    }
}
