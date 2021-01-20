<template>
<div class="container">

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">قائمة الدليفرى</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">اضافة دليفرى<i class="fas fa-user-plus fa-fw"></i></button>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>الرقم التعريفى</th>
                                    <th>عنوان الدليفرى</th>
                                    <th>سعر التوصيل</th>
                                    <th>تعديل</th>
                                </tr>
                                <tr v-for="del in delivery.data" :key="del.id">
                                    <td>{{ del.id }}</td>
                                    <td>{{ del.address }}</td>
                                    <td>{{ del.delivery_price }}</td>
                                    <td>
                                        <a href="#" @click="editModal(del)">
                                            <i class="fa fa-edit blue"></i>
                                        </a>
                                        /
                                        <a href="#" @click="deleteModal(del.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="delivery" @pagination-change-page="getResults"></pagination>
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
                                    <h5 class="modal-title" id="addNewLabel">{{ editmode?'تعديل بيانات الدليفرى':'تسجيل بيانات الدليفرى' }}</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editmode ? updateRes() : createRes()">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="address" class="col-md-4">عنوان الدليفرى :</label>
                            <div class="col-md-8">
                                <input id="address" v-model="form.address" type="text" class="form-control" name="address" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4"> سعر التوصيل :</label>
                            <div class="col-md-8">
                                <input id="delivery_price" v-model="form.delivery_price" type="number" class="form-control" name="delivery_price" required>
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
            delivery: {},

            form: new Form({
                id: '',
                address:'',
                delivery_price:'',
            })
        }
    },
    methods: {
        getResults: function () {
            axios.get("api/delivery").then((res) => {
                this.delivery = res.data
            });
        },

        newModal() {
            this.form.reset()
            this.editmode = false
            $('#addNew').modal('show');
        },

        createRes() {
            this.$Progress.start();
            this.form.post('api/delivery').then(() => {
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

        editModal(del) {
            this.editmode = true
            this.form.fill(del)
            $('#addNew').modal('show');
        },

        updateRes() {
            this.$Progress.start();
            this.form.put('api/delivery/' + this.form.id).then(() => {
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
                    this.form.delete('api/delivery/' + id).then(() => {
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
