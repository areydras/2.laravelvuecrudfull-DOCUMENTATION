<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                    <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                :src="userImage()"
                                alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ this.form.name }}</h3>

                            <p class="text-muted text-center">{{ this.form.type }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Followers</b> <a class="float-right">221</a>
                            </li>
                            <li class="list-group-item">
                                <b>Following</b> <a class="float-right">162</a>
                            </li>
                            <li class="list-group-item">
                                <b>Fake Friends</b> <a class="float-right" style="color:red">500 Internal server error - Request Timeout</a>
                            </li>
                            </ul>

                            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                        </div>
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                            <div class="tab-pane active" id="settings">
                                <form class="form-horizontal" @submit.prevent="updateProfile()">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName" placeholder="Name" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }">
                                        <has-error :form="form" field="name"></has-error>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail" placeholder="Email"  v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }">
                                        <has-error :form="form" field="email"></has-error>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="col-sm-2 control-label">Phone</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="phone" placeholder="Phone"  v-model="form.phone" :class="{ 'is-invalid': form.errors.has('phone') }">
                                        <has-error :form="form" field="phone"></has-error>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputSkills" placeholder="Skills"  v-model="form.skils" :class="{ 'is-invalid': form.errors.has('skils') }">
                                        <has-error :form="form" field="skils"></has-error>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="inputExperience" placeholder="Experience"  v-model="form.experience" :class="{ 'is-invalid': form.errors.has('experience') }"></textarea>
                                        <has-error :form="form" field="experience"></has-error>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-2 control-label">Image</label>
                                    <div class="image-preview" v-if="imagePreview.length > 0">
                                        <img class="preview" :src="imagePreview">
                                    </div>
                                    <div class="input-group col-sm-10">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile" @change="previewImage">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file if u want change avatar</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="">Upload</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-sm-2 control-label">Password</label>

                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password" placeholder="Isi jika ingin mengubah password" v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }">
                                        <has-error :form="form" field="password"></has-error>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                imagePreview : '',
                form : new Form({
                    id : '',
                    name : '',
                    email : '',
                    phone : '',
                    skils : '',
                    type : '',
                    image : '',
                    experience : '',
                    password : ''
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
        methods: {
            userImage(){
                let image = (this.form.image.length > 255) ?  this.form.image : "image/profile/"+this.form.image //jika form.image panjang karakternya lebih dari 255(berarti pake base64) tampilkan form.image yg baru di cklik jika kurang dari 255 berarti pakai url yg ada didatabase (data di database)
                return image
            },
            previewImage: function(event) {
                let input = event.target

                if (input.files && input.files[0]) { //jika ada file yg di input (dipilih)
                    let reader = new FileReader()// create a new FileReader to read this image and convert to base64 format
                    let file = input.files[0] //console log aja biar ngerti " console.log(input.files) "
                    let limitSize = 1024 * 1024 * 2 //1024*2 = 2kb, 1024 * 1024 * 2 = 2mb, dan seterusnya
                    let imageExtension = file.name.split('.').pop().toUpperCase() //mengambil extensi dari file yg diupload dan mengubahnya menjadi kapital (upperCase())

                    if(imageExtension == 'PNG' || imageExtension == 'JPG' || imageExtension == 'JPEG'){ //jika extensi nya itu gambar
                        if(file.size > limitSize){ // jika file.size nya lebih dari limitSize. console.log(file) biar ngerti
                            Swal.fire({
                                type : 'error',
                                title : 'Oops',
                                text : 'Image is so largest'
                            })
                        }else{
                            reader.onload = (e) => { //jalankan FileReader
                                this.imagePreview = reader.result
                                this.form.image = reader.result //memberikan nilai base64 ke form.image, dari convert reader (FileReader) dengan objek result cek console.log
                            }
                        }
                    }else{
                        Swal.fire({
                            type : 'error',
                            title : 'Oops',
                            text : 'Upload only images'
                        })
                    }

                    // Start the reader job - read file as a data url (base64 format)
                    reader.readAsDataURL(file) //menjalankan FileReader untuk membaca file yg sudah diubah menjadi base64
                }
            },
            updateProfile(){
                this.form.put('api/profile/update', this.config).then((res) => {
                    this.form.fill(res.data)
                    this.imagePreview = ''
                    Toast.fire({
                        type: 'success',
                        title: 'Success update ' + res.data.name
                    })
                })
            }
        },
        mounted() {
            this.form.fill(this.$parent.user)
        }
    }
</script>
