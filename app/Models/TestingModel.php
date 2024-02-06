<?php

namespace App\Models;

use CodeIgniter\Model;

class TestingModel extends Model
{
     // protected $DBGroup          = 'DBIGRACIAS';
     //  protected $table            = 'STUDENT';

    public function tesGetData()
    {
        $db = \Config\Database::connect('DBIGRACIAS');
        $query = $db->query("SELECT * FROM MASTERDATA.STUDENT s WHERE s.STUDENTID ='1402228344'");
        return $query->getResultArray();
    }

}
