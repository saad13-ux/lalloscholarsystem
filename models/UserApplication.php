<?php

class UserApplication
{
    public int $application_id;
    public int $scholarship_id;
    public int $user_id;
    public DateTime $date_applied;
    public string $relationship_to_beneficiary;
    public string $beneficiary_fname;
    public string $beneficiary_lname;
    public string $beneficiary_mname;
    public string $beneficiary_ext_name;
    public string $gender;
    public DateTime $dob;
    public string $pob;
    public int $approved;
    public DateTime $dt_updated;
    public DateTime $dt_created;
}
