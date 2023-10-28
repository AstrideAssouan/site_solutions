<script></script>

<template>
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Demande de services</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Liste des demandes de services</h6>
            </div>
            <div class="card-body">
                <div class="mb-3 d-flex justify-content-end align-items-center">
                    <div class="row">
                        <label for="search" class="col-sm-4 col-form-label">Recherche : </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="search">
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Adresse</th>
                                <th>Service</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td class="d-flex align-items-center">
                                    <button class="btn btn-primary"><i class="bx bx-show"></i></button>
                                    <button class="btn btn-danger mx-3"><i class="bx bx-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</template>