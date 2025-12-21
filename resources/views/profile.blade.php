@extends('layouts.app')

@section('title', 'Admin VSATLink | Profile')

@section('content')
    <div class="container-xxl grow container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Detail Profil</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="../assets/img/avatars/1.png" alt="user-avatar" class="d-block rounded" height="100"
                                width="100" id="uploadedAvatar" />
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" onsubmit="return false">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="fullname" class="form-label">Nama Lengkap</label>
                                    <input class="form-control" type="text" id="fullname" name="fullname"
                                        value="Agil ArRachman" readonly />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="username" class="form-label">Username</label>
                                    <input class="form-control" type="text" name="username" id="username"
                                        value="agilarrachman" readonly />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control" type="text" id="email" name="email"
                                        value="agilarrachman@example.com" placeholder="agilarrachman@example.com"
                                        readonly />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="phone" class="form-label">Nomor Telepon</label>
                                    <input type="number" class="form-control" id="phone" name="phone"
                                        value="081332303211" readonly />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="gender" class="form-label">Jenis Kelamin</label>
                                    <input class="form-control" type="text" id="gender" name="gender" value="Pria"
                                        readonly />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="role" class="form-label">Role</label>
                                    <input class="form-control" type="text" id="role" name="role"
                                        value="Admin Sales" readonly />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="division" class="form-label">Divisi</label>
                                    <input class="form-control" type="text" id="division" name="division"
                                        value="Sales & Marketing" readonly />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="position" class="form-label">Jabatan</label>
                                    <input class="form-control" type="text" id="position" name="position"
                                        value="Head of Sales" readonly />
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
@endsection
