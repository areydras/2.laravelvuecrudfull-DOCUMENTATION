<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-5">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="card-title">Data Users</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="button" class="btn btn-primary" data-toggle="modal" @click="showModal()">
                                    Create User
                                </button>
                            </div>
                        </div>
                    </div>
                <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Skils</th>
                                    <th>Experience</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(user, index) in users.data" :key="user.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>{{ user.phone }}</td>
                                    <td>{{ user.skils }}</td>
                                    <td>{{ user.experience }}</td>
                                    <td>{{ user.created_at|myDate }}</td><!-- parameter|myDate artinya memberikan parameter created_at kepada vue.Filter dengan nama myDate yg ada di (app.js) -->
                                    <td>
                                        <div class="row pr-1 pl-2">
                                            <button class="btn btn-info mr-1" style="color:white" @click="editShow(user)"><i class="fas fa-user-edit"></i></button>
                                            <button class="btn btn-danger ml-1" @click="deleteUser(user.id)"><i class="fas fa-user-times"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <pagination :data="users" @pagination-change-page="getPaginate"></pagination>
                    </div>
            <!-- /.card-body -->
                </div>
          <!-- /.card -->
            </div>
            <!-- MODAL -->
            <div class="modal fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                <form @submit.prevent="editMode ? updateUser() : createUser()">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" v-show="!editMode">Create User</h5>
                            <h5 class="modal-title" v-show="editMode">Edit User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input v-model="form.name" type="text" name="name"
                                            class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                        <has-error :form="form" field="name"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input v-model="form.email" type="email" name="email"
                                            class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                        <has-error :form="form" field="email"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input v-model="form.phone" type="text" name="phone"
                                            class="form-control" :class="{ 'is-invalid': form.errors.has('phone') }">
                                        <has-error :form="form" field="phone"></has-error>
                                    </div>

                                    <div class="form-group">
                                        <label>Skils</label>
                                        <input v-model="form.skils" type="text" name="skils"
                                            class="form-control" :class="{ 'is-invalid': form.errors.has('skils') }">
                                        <has-error :form="form" field="skils"></has-error>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input v-model="form.password" type="password" name="password" v-show="!editMode"
                                            class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                        <input v-model="form.password" type="password" name="password" v-show="editMode"
                                            class="form-control" :class="{ 'is-invalid': form.errors.has('password') }" placeholder="Isi jika ingin mengubah password">
                                        <has-error :form="form" field="password"></has-error>
                                    </div>

                                    <div class="form-group" v-show="!editMode">
                                        <label>Re-Password</label>
                                        <input v-model="form.password_confirmation" type="password" name="password_confirmation"
                                            class="form-control" :class="{ 'is-invalid': form.errors.has('password_confirmation') }">
                                        <has-error :form="form" field="password_confirmation"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label>Experience</label>
                                        <textarea v-model="form.experience" type="text" name="experience"
                                            class="form-control" :class="{ 'is-invalid': form.errors.has('experience') }">
                                        </textarea>
                                        <has-error :form="form" field="experience"></has-error>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" v-show="editMode">Save changes</button>
                            <button type="submit" class="btn btn-primary" v-show="!editMode">Create</button>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                users : {},
                editMode : false,
                form : new Form({
                    id : '',
                    name : '',
                    email : '',
                    phone : '',
                    skils : '',
                    experience : '',
                    password : '',
                    password_confirmation : ''
                }),

                // config untuk laravel passport mengirim token
                config : {
                    //mengirim data tipe headers 
                        headers: {
                                    //dengan key authorization(auth): Bearer + Token API nya
                                    Authorization: "Bearer " + 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImFjOTIzNGVlMGFhOThjYjAzYzk0ODE5MWZlNzc1NDg5MDBiOTY3ZDk1MTlhMzNmNTIyMGQ3YjkwNmRjZjY3ZGNlN2Q4ZTc1NzM2YmJhODUzIn0.eyJhdWQiOiIxIiwianRpIjoiYWM5MjM0ZWUwYWE5OGNiMDNjOTQ4MTkxZmU3NzU0ODkwMGI5NjdkOTUxOWEzM2Y1MjIwZDdiOTA2ZGNmNjdkY2U3ZDhlNzU3MzZiYmE4NTMiLCJpYXQiOjE1NjAwMTE5NTYsIm5iZiI6MTU2MDAxMTk1NiwiZXhwIjoxNTkxNjM0MzU2LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.cWpLwdzvaLbu3wWAYqDt-lPHmvXQa6S93YWORktHJP5lBowETseAxngc9BRf-fNpHYZRFKbYD7PuL5rk9AJXJ4Q5ejSoDGmHqKipaeF6fsaVH-A2vaWsZVwBkDbWlFmHPgAaBYTeJvMcZidT-QE0yH7uJbLqA0ApqCgDdaoBPiCha7FGGyq3r5bd_yev2tbd2oFZ383vUOJwSoNPwRt5kkeBGU-LUoM7YRH62Bn2ciFjsOyOUW3nWhOwSSHMehVIhzej-jJFY9wfT-2OP9HOO475M2xgd1VwLjVotNGy7y3bYTgpYN-Ly3tI_g8k6w9nrva-wIhd_U8KsOII6-46tFaxOFLake-rr-6ezxggaZa7ku9rgEm9OlkH_JGS9W30KQymOvsA3bwOolbvHVZ5B2VcHoZPWqZd4YliqsRx8AxiM0rffOoxWyZVAzp_Hwxrtnm3AmgswZMBuCkC4vNjYhfMIYlyEtOZIB3W6VH59UsPXrakX5blDeZ3ZDOAGpHvAVEb_ZnR2tfVBNZTNmQ8aZEzQM0tGZG13Mm-Is_5TShhSqfJpjP-w2pYQIGceDhk6g-BXv6I9Eg94vs_pLrDO0cB21m0zlB-lrB7Y9plX5AFxn_GGbaoeCcjnajKAPopEUOHo7rzHDOfXtXuEF35qXVqkRu31EVBGOMFx3h5jYA',
                                    //dengan content type json
                                    'Content-Type': 'application/json'
                                }
                            }
            }
        },
        methods : {
            showModal(){
                this.editMode = false
                this.form.clear()
                this.form.reset()
                $('#modal').modal('show')
            },
            editShow(user){
                this.form.clear()
                this.form.reset()
                this.editMode = true
                $('#modal').modal('show')
                this.form.fill(user)
            },
            getPaginate(page = 1) {
                axios.get('api/users?page=' + page, this.config).then(response => {
                        this.users = response.data;
                });
            },
            getUsers(){
                axios.get('api/users', this.config).then((res) => { //ketikan ingin menggunakan api tersebut kita gunakan config disampingnnya
                    this.users = res.data
                }).catch((err) => {
                    console.log(err)
                })
            },
            createUser(){
                this.form.post('api/users', this.config).then((res) => {
                    this.getUsers()
                    $('#modal').modal('hide')
                    Toast.fire({
                        type: 'success',
                        title: 'Success create user'
                    })
                }).catch((err) => {
                    console.log(err)
                })
            },
            updateUser(){
                this.form.put('api/users/' + this.form.id, this.config).then((res) => {
                    this.getUsers()
                    $('#modal').modal('hide')
                    Toast.fire({
                        type: 'success',
                        title: 'Success update user ' + this.form.name
                    })
                }).catch((err) => {
                    console.log(err)
                })
            },
            deleteUser(id){
                axios.get('api/users/' + id, this.config).then((res) => {
                    let name = res.data.name
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You want to delete " + name,
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.value) {
                            this.form.delete('api/users/' + id, this.config).then((res) => {
                                this.getUsers()
                                    Swal.fire(
                                    'Deleted!',
                                    name + ' has been deleted.',
                                    'success'
                                    )
                            })
                        }
                    })
                })
            }
        },
        created() { //created ini berfungsi untuk menampilkan data ke halaman
            Fire.$on('searching', () =>{ //menggunakan function searching yg dibuat pada (app.js)
                let query = this.$parent.search //memanggil data object dari file parent (app.js)
                axios.get('api/search?user='+query, this.config).then((res) => {
                    this.users = res.data
                    console.log(this.users)
                })
            })
            this.getUsers()
        },
    }
</script>