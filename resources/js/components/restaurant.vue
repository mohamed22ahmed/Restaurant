<template>
<div class="container">

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">قائمة المطاعم</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">اضافة مطعم<i class="fas fa-user-plus fa-fw"></i></button>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>الرقم التعريفى</th>
                                    <th>إسم المطعم</th>
                                    <th>رقم المطعم</th>
                                    <th>عنوان المطعم</th>
                                    <th>تعديل</th>
                                </tr>
                                <tr v-for="res in restaurants.data" :key="res.id">
                                    <td>{{ res.id }}</td>
                                    <td>{{ res.name }}</td>
                                    <td>{{ res.phone }}</td>
                                    <td>{{ res.address }}</td>
                                    <td>
                                        <a href="#" @click="editModal(res)">
                                            <i class="fa fa-edit blue"></i>
                                        </a>
                                        /
                                        <a href="#" @click="deleteRes(res.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="restaurants" @pagination-change-page="getResults"></pagination>
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
                    <h5 class="modal-title" id="addNewLabel">{{ editmode?'تعديل مطعم':'تسجيل مطعم' }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editmode ? updateRes() : createRes()">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-4">إسم المطعم :</label>
                            <div class="col-md-8">
                                <input id="name" v-model="form.name" type="text" class="form-control" name="name" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4">رقم المطعم :</label>
                            <div class="col-md-8">
                                <input id="phone" v-model="form.phone" type="text" class="form-control" name="phone" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4">عنوان المطعم :</label>
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
            restaurants: {},

            form: new Form({
                id: '',
                name: '',
                phone: '',
                address: '',
            })
        }
    },
    methods: {
        getResults: function () {
            axios.get("api/restaurant").then((res) => {
                this.restaurants = res.data
            });
        },

        newModal() {
            this.form.reset()
            this.editmode = false
            $('#addNew').modal('show');
        },

        createRes() {
            this.$Progress.start();
            this.form.post('api/restaurant').then(() => {
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

        editModal(res) {
            this.editmode = true
            this.form.fill(res)
            $('#addNew').modal('show');
        },

        updateRes() {
            this.$Progress.start();
            this.form.put('api/restaurant/' + this.form.id).then(() => {
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

        deleteRes(id) {
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
                    this.form.delete('api/restaurant/' + id).then(() => {
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
