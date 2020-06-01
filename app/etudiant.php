<?php

namespace App;
use App\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Eloquent\Model;

class etudiant extends Model
{
    protected $guarded = [];
    public function importToDb($filiere)
    {
        $path = resource_path('pending-files/*.csv');
        $files = glob($path);

        foreach(array_slice($files,0,1) as $file)
        {
            $data = array_map('str_getcsv',file($file));
            foreach($data as $row)
            {
                etudiant::updateOrCreate([
                    'nApogee' => $row[0],
                    'email' => $row[3],
                ],[
                    'nom' => $row[1],
                    'prenom' => $row[2],
                    'classe' => $row[4],
                    'groupe' => $row[5],
                    'filiere' =>$filiere,
                ]);
                User::updateOrCreate([
                    'email' => $row[3],
                ],[
                    'name' => $row[1].' '.$row[2],
                    'password' => Hash::make($row[0]),
                    'type' => 'etudiant',
                ]);
            }
            unlink($file);
        }
    }
}
