<template>
    <div class="container">

        <div class="container">
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style="float:right;">قائمة المبيعـــات</h3>
                        </div>

                        <div class="card-header row" style="float:right;">
                                <div class="col-md-2">
                                    <label for="filters">المبيعات على أساس</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" name="filters" v-model="filters" @change="getResults">
                                </div>
                        </div>

                        <div class="card-body table-responsive table-bordered p-0">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th>الرقم التعريــفى</th>
                                        <th>اسم المستخدم</th>
                                        <th>إسم العميــل</th>
                                        <th>العنــوان</th>
                                        <th>رقم التليفـون</th>
                                        <th>عدد الطلبــات</th>
                                        <th>السعر الإجمالــى</th>
                                        <th>حذف</th>
                                    </tr>
                                    <tr v-for="sale in sales.data" :key="sale.id">
                                        <td>{{ sale.id }}</td>
                                        <td>{{ sale.user_name }}</td>
                                        <td>{{ sale.name }}</td>
                                        <td>{{ sale.address }}</td>
                                        <td>{{ sale.phone }}</td>
                                        <td>{{ sale.food_list }}</td>
                                        <td>{{ sale.total_price }}</td>
                                        <td>
                                            <a href="#" @click="deleteModal(sale.id)">
                                                <i class="fa fa-trash red"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <pagination :data="sales" @pagination-change-page="getResults"></pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            sales:{},
            filters: new Date().toISOString().slice(0, 10),
        }
    },
    methods: {
        getResults() {
            axios.get("api/get_sales/"+this.filters).then((res) => {
                this.sales=res
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
                    axios.get('api/delete_order/' + id).then(() => {
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
