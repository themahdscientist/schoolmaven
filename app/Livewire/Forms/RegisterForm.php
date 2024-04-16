<?php

namespace App\Livewire\Forms;

use Carbon\Carbon;
use Livewire\Form;
use App\Models\Role;
use App\Models\User;
use App\Models\State;
use App\Models\School;
use App\Models\Country;
use Illuminate\Support\Str;
use App\Models\Administrator;
use Livewire\Attributes\Validate;
use Illuminate\Auth\Events\Registered;

class RegisterForm extends Form
{
    #[Validate('required|string', as: 'name')]
    public $s_name;

    #[Validate('required|string', as: 'alias')]
    public $s_alias;

    #[Validate('required|string', as: 'address')]
    public $s_addr;

    #[Validate('required|integer', as: 'country')]
    public $country;

    #[Validate('required|integer', as: 'state')]
    public $state;

    #[Validate('required|integer', as: 'lga')]
    public $lga;

    #[Validate('required|numeric', as: 'pmb')]
    public $s_pmb;

    #[Validate('required|email', as: 'email')]
    public $s_email;

    #[Validate('required|string', as: 'url')]
    public $s_url;

    #[Validate('required|array|min:1', as: 'type')]
    public $s_type = [];

    #[Validate('sometimes|array', as: 'affiliates')]
    public $s_affiliates = [];

    #[Validate('required|string', as: 'accreditation')]
    public $s_accredit;

    #[Validate('required|string', as: 'location')]
    public $s_location;

    #[Validate('required|image|max:1024', as: 'logo')]
    public $s_logo;

    #[Validate('required|date', as: 'established date')]
    public $s_est;

    #[Validate('required|string|ascii', as: 'mission')]
    public $s_mission;

    #[Validate('required|string|ascii', as: 'vision')]
    public $s_vision;

    #[Validate('required|string', as: 'first name')]
    public $u_fname;

    #[Validate('sometimes|string', as: 'middle name')]
    public $u_mname;

    #[Validate('required|string', as: 'last name')]
    public $u_lname;

    #[Validate('required|date', as: 'date of birth')]
    public $u_dob;

    #[Validate('required|string', as: 'gender')]
    public $u_gender;

    #[Validate('required|string', as: 'position')]
    public $u_position;

    #[Validate('required', as: 'phone')]
    public $u_phone;

    #[Validate('required', as: 'religion')]
    public $u_religion;

    #[Validate('required|email|unique:users,email', as: 'email')]
    public $u_email;

    #[Validate('required|image|max:1024', as: 'avatar')]
    public $u_avatar;

    #[Validate('required|string|confirmed', as: 'password')]
    public $password;

    #[Validate('required|string', as: 'password')]
    public $password_confirmation;

    public $countries;
    public $states;
    public $lgas;

    protected function generateSMILCode(): string
    {
        $nameParts = explode(' ', $this->s_name);
        $smilCode = '';

        switch (count($nameParts)) {
            case 1:
                // For mono-worded school name
                $smilCode .= substr($nameParts[0], 0, 4);
                break;
            case 2:
                // For dual-worded school name
                foreach ($nameParts as $part) {
                    $smilCode .= substr($part, 0, 2);
                }
                break;
            case 3:
                // For tri-worded school name
                $smilCode .= substr($nameParts[0], 0, 2);
                $smilCode .= substr($nameParts[1], 0, 1);
                $smilCode .= substr($nameParts[2], 0, 1);
                break;
            default:
                // For four-worded school name and beyond
                foreach ($nameParts as $part) {
                    $smilCode .= substr($part, 0, 1);
                }
                break;
        }

        // Append the variable part of the SMIL code
        $smilCode .= Country::findOrFail($this->country)->value('iso2');
        $smilCode .= explode('-', State::findOrFail($this->state)->value('iso2'))[1];
        $smilCode .= $this->s_location;

        return strtoupper($smilCode);
    }

    protected function generateUsername(): mixed
    {
        $date = Carbon::now()->year;
        $hour  = Carbon::now()->hour;
        $second  = Carbon::now()->second;
        return substr($date, 0, 2) .
            strtolower(Str::trim($this->u_fname) .
                substr(Str::trim($this->u_lname), 0, 1) .
                substr(Str::trim($this->u_lname), -1, 1)) .
            substr($date, -2) . $hour . $second;
    }

    protected function generateAdminCode(): mixed
    {
        $date = Carbon::now()->year;
        $hour  = Carbon::now()->hour;
        $second  = Carbon::now()->second;
        $positionShortForms = [
            'administrator' => 'ADM',
            'principal' => 'PRN',
            'owner' => 'OWN',
        ];

        return substr($date, 0, 2) .
            $this->generateSMILCode() .
            $positionShortForms[$this->u_position] .
            substr($date, -2) . $hour . $second;
    }

    public function store()
    {
        $this->validate();

        // School
        $school = new School;
        $school->smil_code = $this->generateSMILCode();
        $school->name = $this->s_name;
        $school->alias = $this->s_alias;
        $school->address = $this->s_addr;
        $school->lga_id = $this->lga;
        $school->state_id = $this->state;
        $school->country_id = $this->country;
        $school->postal_code = $this->s_pmb;
        $school->info = [
            'email' => $this->s_email,
            'url' => $this->s_url,
        ];
        $school->accreditation = $this->s_accredit;
        $school->type = $this->s_type;
        $school->affiliation = $this->s_affiliates;
        $school->mission = $this->s_mission;
        $school->vision = $this->s_vision;
        $school->established_date = $this->s_est;
        $school->logo = $this->s_logo->store('logos', 'public');
        $school->save();

        // User
        $user = new User;
        $user->school_id = $school->id;
        $user->username = $this->generateUsername();
        $user->email = $this->u_email;
        $user->password = $this->password_confirmation;
        $user->first_name = $this->u_fname;
        $user->middle_name = $this->u_mname;
        $user->last_name = $this->u_lname;
        $user->gender = $this->u_gender;
        $user->dob = $this->u_dob;
        $user->religion = $this->u_religion;
        $user->phone = $this->u_phone;
        $user->address = $this->s_addr;
        $user->postal_code = $this->s_pmb;
        $user->lga_id = $this->lga;
        $user->state_id = $this->state;
        $user->country_id = $this->country;
        $user->lga_origin_id = $this->lga;
        $user->state_origin_id = $this->state;
        $user->nationality_id = $this->country;
        $user->avatar = $this->u_avatar->store('avatars', 'public');
        $user->save();
        $user->roles()->attach(Role::ADMIN);

        // Admin
        $admin = new Administrator;
        $admin->user_id = $user->id;
        $admin->administrator_code = $this->generateAdminCode();
        $admin->position = $this->u_position;
        $admin->save();

        request()->session()->regenerate();
        auth()->login($user);

        event(new Registered($user));

        $this->reset();
    }
}
