<template>
<div class="container">

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="float:right;">قائمة الطعام</h3>

                        <div class="card-tools" style="float:left;">
                            <button class="btn btn-success" @click="newModal">اضافة طعام<i class="fas fa-user-plus fa-fw"></i></button>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>الرقم التعريــفى</th>
                                    <th>إسم المطعم</th>
                                    <th> اسم الطعام </th>
                                    <th> السعر </th>
                                    <th>تعــديل</th>
                                </tr>
                                <tr v-for="menu in menus.data" :key="menu.id">
                                    <td>{{ menu.id }}</td>
                                    <td>{{ menu.name }}</td>
                                    <td>{{ menu.food }}</td>
                                    <td>{{ menu.price }}</td>
                                    <td>
                                        <a href="#" @click="editModal(menu)">
                                            <i class="fa fa-edit blue"></i>
                                        </a>
                                        /
                                        <a href="#" @click="deleteModal(menu.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="menus" @pagination-change-page="getResults"></pagination>
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
                    <h5 class="modal-title" id="addNewLabel">{{ editmode?'تعديل الطعام':'تسجيل الطعام' }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editmode ? updateRes() : createRes()">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="period" class="col-md-4">المطعم :</label>
                            <div class="col-md-8">
                                <select class="form-control" v-model="form.restaurant_id">
                                    <option v-for="res in restaurants" :key="res.id" :value="res.id">{{ res.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4"> الطعام :</label>
                            <div class="col-md-8">
                                <input id="food" v-model="form.food" type="text" class="form-control" name="food" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4"> سعر الطعام :</label>
                            <div class="col-md-8">
                                <input id="price" v-model="form.price" type="number" class="form-control" name="price" required>
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
            menus: {},
            restaurants: {},

            form: new Form({
                id: '',
                restaurant_id: '',
                price: '',
                food: '',
            })
        }
    },
    methods: {
        getResults: function () {
            axios.get("api/menu").then((res) => {
                this.menus = res.data
            });
        },

        get_clients() {
            axios.get("api/menu_get_restaurants").then((res) => {
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
            this.form.post('api/menu').then(() => {
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
            this.form.put('api/menu/' + this.form.id).then(() => {
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
                    this.form.delete('api/menu/' + id).then(() => {
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
