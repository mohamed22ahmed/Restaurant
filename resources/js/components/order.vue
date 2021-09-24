<template>
<div class="container">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        إنشـــاء طلـــب
                    </div>

                    <div class="card-body">
                        <form @submit.prevent="createRes">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">معلومات العميــل</a>
                                    <a class="nav-item nav-link" id="nav-menu-tab" data-toggle="tab" href="#nav-menu" role="tab" aria-controls="nav-menu" aria-selected="false">الطعــام</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="container-fluid">
                                        <div class="row mt-5">
                                            <div class="col-12">
                                                <div class="form-group row">
                                                    <label for="name" class="col-md-4">إسم العميل :</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="name" v-model="form.name" id="name">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="phone" class="col-md-4">رقم العميل :</label>
                                                    <div class="col-md-8">
                                                        <input type="text" v-model="form.phone" class="form-control" name="phone" id="phone">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="address" class="col-md-4">عنوان العميل :</label>
                                                    <div class="col-md-8">
                                                        <input type="text" v-model="form.address" class="form-control" name="address" id="address">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="period" class="col-md-4">الدليفرى :</label>
                                                    <div class="col-md-8">
                                                        <select class="form-control" v-model="form.delivery_id">
                                                            <option v-for="delv in delivery" :key="delv.id" :value="delv.id">{{ delv.address }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="nav-menu" role="tabpanel" aria-labelledby="nav-menu-tab">
                                    <div class="row mt-5">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 for="restaurant" class="col-md-4">إختار مطعم :</h5>
                                                    <div class="col-md-3">
                                                        <select class="form-control" name="restaurant_id" v-model="form.restaurant_id" @change="get_menu">
                                                            <option v-for="res in restaurants" :key="res.id" :value="res.id">{{ res.name }}</option>
                                                        </select>
                                                    </div>

                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered table-striped" id="Table">
                                                                <thead>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th>الرقم التعريفى</th>
                                                                        <th>إسم المطعم</th>
                                                                        <th>إسم الطعام</th>
                                                                        <th>السعر</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="menu in menus" :key="menu.id">
                                                                        <td><input type="checkbox" v-model="form.userIds" @click="select(menu.id,menu.food)" :value="menu.id"></td>
                                                                        <td>{{ menu.id }}</td>
                                                                        <td>{{ menu.name }}</td>
                                                                        <td>{{ menu.food }}</td>
                                                                        <td>{{ menu.price }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group pt-2 ml-3 float-right">
                                            <button class="btn btn-success" type="submit">إنشـــاء</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="order" tabindex="-1" role="dialog" aria-labelledby="orderLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="orderLabel">الفاتورة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="card-body" id="printTable">
                    <div class="modal-header justify-content-center">
                        <img src="storage/noImage.jpg" alt="logo" width="100px" height="100px" class="rounded-circle img-responsive">
                    </div>
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>اسم العميل</th>
                                <td>
                                    {{ order.name }}
                                </td>
                                <th>عدد الطلبات</th>
                            </tr>
                            <tr>
                                <th>رقم العميل</th>
                                <td>
                                    {{ order.phone }}
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>عنوان العميل</th>
                                <td>
                                    {{ order.address }}
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>سعر التوصيل</th>
                                <td>
                                    {{ order.delivery }}
                                </td>
                                <td></td>
                            </tr>
                            <tr v-for="(food,indx) in foods" :key="food.id">
                                <th>{{ food.food }}</th>
                                <td>
                                    {{ food.price }}
                                </td>
                                <td>{{ parseInt(order_numbers_arr[indx]) }}</td>
                            </tr>
                            <tr>
                                <th>السعر الاجمالى</th>
                                <th>
                                    {{ total(order.total_price,order.delivery) }}
                                </th>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <button class="btn btn-info" @click="print"><i class="fas fa-print fa-fw"></i>&nbsp; طباعة</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Numbers -->
    <div class="modal fade" id="orderNumber" tabindex="-1" role="dialog" aria-labelledby="orderNumberLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderNumberLabel">عدد الطلبات</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="order_numbers">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-4">إسم الطلب :</label>
                            <div class="col-md-8">
                                <input type="text" disabled class="form-control" name="order_name" :value="orderNumberForm.order_name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4">عدد الطلبات :</label>
                            <div class="col-md-8">
                                <input v-model="orderNumberForm.ordernum" type="number" class="form-control" name="ordernum" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">حفظ</button>
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
            delivery: {},
            foods: {},
            order: {},
            order_numbers_arr:[],

            form: new Form({
                id: '',
                name: '',
                phone: '',
                address: '',
                restaurant_id: '',
                delivery_id: '',
                userIds: [],
                orderNum: []
            }),

            orderNumberForm:new Form({
                ordernum:0,
                order_name:'',
            })
        }
    },

    methods: {
        print() {
            let routeData = this.$router.resolve({name: 'printing', query: {data:order }});
            window.open("/printing?id="+this.order.id, '_blank')
        },

        order_numbers(){
            this.form.orderNum.push(this.orderNumberForm.ordernum)
            $('#orderNumber').modal('hide');
        },

        total(x, y) {
            return parseInt(x) + parseInt(y)
        },

        select(id,name) {
            this.orderNumberForm.reset()
            for (var i = 0; i < this.form.userIds.length; i++){
                if (this.form.userIds[i] == id)
                {
                    this.form.userIds.splice(i, 1);
                    this.form.orderNum.splice(i, 1);
                    return
                }
            }

            this.form.userIds.push(id);
            this.orderNumberForm.order_name=name
            $('#orderNumber').modal('show');
        },

        get_restaurants() {
            axios.get("api/menu_get_restaurants").then((res) => {
                this.restaurants = res.data
            });
            this.get_delivery()
        },

        get_delivery() {
            axios.get("api/order_get_delivery").then((res) => {
                this.delivery = res.data
            });
        },

        get_foods() {
            axios.get("api/order_get_foods/" + this.form.userIds).then((res) => {
                this.foods = res.data[0]
                this.order_numbers_arr = res.data[1]
            });
        },

        get_menu() {
            axios.get('api/order_get_menu/' + this.form.restaurant_id).then((res) => {
                this.menus = res.data
            })
        },

        get_order() {
            axios.get('api/order').then((res) => {
                this.order = res.data[0]
            })
        },

        newModal() {
            this.form.reset()
            this.editmode = false
            $('#addNew').modal('show');
        },

        createRes() {
            if (this.form.userIds != []) {
                this.$Progress.start();
                this.form.post('api/order').then(() => {
                    swal.fire(
                        'Success!',
                        'تم عمل الاوردر بنجاح',
                        'success'
                    )
                    this.$Progress.finish();
                    this.get_foods()
                    this.get_order()
                    $('#order').modal('show');
                })
            }
        },
    },

    created() {
        this.get_restaurants()
        this.form.userIds = []
        this.form.orderNum = []
    },
}
</script>
