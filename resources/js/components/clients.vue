<template>
<div class="container">

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools" style="float:left;">
                            <button class="btn btn-success" @click="newModal">
                                <i class="fas fa-user-plus fa-fw"></i>&nbsp; اضافة عميـل
                            </button>
                        </div>
                        <h3 class="card-title" style="float:right;">قائمة العملاء</h3>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>الرقم التعريفى</th>
                                    <th>إسم العميل</th>
                                    <th>رقم العميل</th>
                                    <th>عنوان العميل</th>
                                    <th>تعديل</th>
                                </tr>
                                <tr v-for="client in clients.data" :key="client.id">
                                    <td>{{ client.id }}</td>
                                    <td>{{ client.name }}</td>
                                    <td>{{ client.phone }}</td>
                                    <td>{{ client.address }}</td>
                                    <td>
                                        <a href="#" @click="editModal(client)">
                                            <i class="fa fa-edit blue"></i>
                                        </a>
                                        /
                                        <a href="#" @click="deleteModal(client.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="clients" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewLabel">{{ editmode?'تعديل بيانات العميل':'تسجيل بيانات العميل' }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editmode ? updateRes() : createRes()">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-4">إسم العميل :</label>
                            <div class="col-md-8">
                                <input id="name" v-model="form.name" type="text" class="form-control" name="name" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4">رقم العميل :</label>
                            <div class="col-md-8">
                                <input id="phone" v-model="form.phone" type="text" class="form-control" name="phone" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4">عنوان العميل :</label>
                            <div class="col-md-8">
                                <textarea id="address" v-model="form.address" type="text" class="form-control" name="address" cols="20" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button v-show="!editmode" type="submit" class="btn btn-success">تسجيل</button>
                        <button v-show="editmode" type="submit" class="btn btn-primary">تعديل</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data: function () {
        return {
            editmode: false,
            clients: {},

            form: new Form({
                id: '',
                name:'',
                phone:'',
                address:'',
            })
        }
    },
    methods: {
        getResults: function () {
            axios.get("api/clients").then((res) => {
                this.clients = res.data
            });
        },

        newModal() {
            this.form.reset()
            this.editmode = false
            $('#addNew').modal('show');
        },

        createRes() {
            this.$Progress.start();
            this.form.post('api/clients').then(() => {
                $('#addNew').modal('hide');
                swal.fire(
                    'Success!',
                    'تم حفظ البيانات بنجاح',
                    'success'
                )
                this.$Progress.finish();
                Fire.$emit('AfterCreate');
            }).catch(() => {
                this.$Progress.fail();
            });
        },

        editModal(client) {
            this.editmode = true
            this.form.fill(client)
            $('#addNew').modal('show');
        },

        updateRes() {
            this.$Progress.start();
            this.form.put('api/clients/' + this.form.id).then(() => {
                $('#addNew').modal('hide');
                swal.fire(
                    'Updated!',
                    'تم تعديل البيانات بنجاح',
                    'success'
                )
                this.$Progress.finish();
                Fire.$emit('AfterCreate');
            }).catch(() => {
                this.$Progress.fail();
            });
        },

        deleteModal(id) {
            swal.fire({
                title: 'متأكد ؟',
                text: "لا يمكنك استرجاع البيانات",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم متأكد !'
            }).then((result) => {
                if (result.value) {
                    this.form.delete('api/clients/' + id).then(() => {
                        swal.fire(
                            'Deleted!',
                            'تم الحذف بنجاح',
                            'success'
                        )
                        Fire.$emit('AfterCreate');
                    })
                }
            })
        }

    },

    created() {
        this.getResults();
        Fire.$on('AfterCreate', () => {
            this.getResults();
        });
    },
}
</script>
