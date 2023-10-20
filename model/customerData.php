<?php

// class deddiee au fetch de tt les tables avec info client en relation avec id_customer
//class fetch client data, tables relate by id_customer

class CustomerData
{
    private $pdo;
    

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

      // this function fetches general customer data
    // cette function fetch retourne des infos client plus enerale


    public function display_dataCustomer($limit)
    {
        $sql = "SELECT * FROM ps_customer ORDER BY id_customer DESC ";
        if ($limit !== null) {
            $sql .= " LIMIT :limit"; // Query parametre au niveau securité
            $data_Customer = $this->pdo->prepare($sql);
            $data_Customer->bindParam(':limit', $limit, PDO::PARAM_INT);
        } else {
            $data_Customer = $this->pdo->prepare($sql);
        }
        // $data_Customer = $this->pdo->prepare("SELECT * FROM ps_customer"); dans le cas d'aucune necessite de limit
        $data_Customer->execute();
        return $data_Customer->fetchAll(PDO::FETCH_ASSOC);
    }


    // this function fetches the address client data for a certain id customer
    // cette function fetch retourne des infos adresse pour un certain id customer

    public function display_dataCustomerAddress($id_customer)
    {
        $sql = "SELECT * FROM ps_address WHERE id_customer = :id_customer";
        $dataCustomerAddress = $this->pdo->prepare($sql);
        $dataCustomerAddress->bindParam(':id_customer', $id_customer, PDO::PARAM_INT);
        $dataCustomerAddress->execute();
        return $dataCustomerAddress->fetchAll(PDO::FETCH_ASSOC);
    }

}














