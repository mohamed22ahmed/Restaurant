<template>
<div class="container">

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="float:right;">قائمة الاشتراكات</h3>

                        <div class="card-tools" style="float:left;">
                            <button class="btn btn-success" @click="newModal">
                                <i class="fas fa-plus fa-fw"></i>&nbsp; اضافة اشتراك
                            </button>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>الرقم التعريــفى</th>
                                    <th>نوع الاشتــراك</th>
                                    <th>إسم العميــل</th>
                                    <th>عنوان العميــل</th>
                                    <th>رقم العميــل</th>
                                    <th>تاريخ الاشتــراك </th>
                                    <th> ملاحظــات </th>
                                    <th>تعــديل</th>
                                </tr>
                                <tr v-for="sub in subs.data" :key="sub.id">
                                    <td>{{ sub.id }}</td>
                                    <td>{{ sub.subscription }}</td>
                                    <td>{{ sub.name }}</td>
                                    <td>{{ sub.address }}</td>
                                    <td>{{ sub.phone }}</td>
                                    <td>{{ sub.created_at }}</td>
                                    <td>{{ sub.notes }}</td>
                                    <td>
                                        <a href="#" @click="editModal(sub)">
                                            <i class="fa fa-edit blue"></i>
                                        </a>
                                        /
                                        <a href="#" @click="deleteModal(sub.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="subs" @pagination-change-page="getResults"></pagination>
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
                    <h5 class="modal-title" id="addNewLabel">{{ editmode?'تعديل الاشتراك':'تسجيل الاشتراك' }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editmode ? updateRes() : createRes()">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-4">نوع الاشتراك :</label>
                            <div class="col-md-8">
                                <input id="subscription" v-model="form.subscription" type="text" class="form-control" name="subscription" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4"> سعر الاشتراك :</label>
                            <div class="col-md-8">
                                <input id="price" v-model="form.price" type="number" class="form-control" name="price" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="period" class="col-md-4">المدة :</label>
                            <div class="col-md-8">
                                <input id="period" v-model="form.period" type="number" class="form-control" name="period" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="period" class="col-md-4">العميل :</label>
                            <div class="col-md-8">
                                <select class="form-control" v-model="form.client_id">
                                <option v-for="client in clients" :key="client.id" :value="client.id">{{ client.name }}</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="supplier_name" class="col-md-4"> إسم المورد :</label>
                            <div class="col-md-8">
                                <input id="supplier_name" v-model="form.supplier_name" type="text" class="form-control" name="supplier_name" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4">ملاحظات :</label>
                            <div class="col-md-8">
                                <textarea id="notes" v-model="form.notes" type="text" class="form-control" name="notes" cols="20"></textarea>
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
            subs: {},
            clients:{},

            form: new Form({
                id: '',
                subscription:'',
                client_id:'',
                price:'',
                period:'',
                supplier_name:'',
            })
        }
    },
    methods: {
        getResults: function () {
            axios.get("api/monthly_sub").then((res) => {
                this.subs = res.data
            });
        },

        get_clients(){
            axios.get("api/monthly_sub_get_clients").then((res) => {
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
            this.form.post('api/monthly_sub').then(() => {
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
            this.form.put('api/monthly_sub/' + this.form.id).then(() => {
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
                    this.form.delete('api/monthly_sub/' + id).then(() => {
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
        this.get_clients()
        Fire.$on('AfterCreate', () => {
            this.getResults();
        });
    },
}
</script>
