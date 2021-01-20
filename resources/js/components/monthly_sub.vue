<template>
<div class="container">

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">قائمة الاشتراكات</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">اضافة اشتراك<i class="fas fa-user-plus fa-fw"></i></button>
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
                            </tbody>
                        </table>
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
                <form>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-4">نوع الاشتراك :</label>
                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control" name="name" required autocomplete="name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4"> سعر الاشتراك :</label>
                            <div class="col-md-8">
                                <input id="price" type="number" class="form-control" name="price" required autocomplete="type">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="period" class="col-md-4">المدة :</label>
                            <div class="col-md-8">
                                <input id="period" type="number" class="form-control" name="period" required autocomplete="type">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="supplier_name" class="col-md-4"> إسم المورد :</label>
                            <div class="col-md-8">
                                <input id="supplier_name" type="text" class="form-control" name="supplier_name" required autocomplete="type">
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
            editmode:false,
        }
    },
    methods: {
        loadUsers: function () {
            axios.get("api/monthly_sub").then((res) => {
                console.log(res.data)
            });
        },

        newModal() {
            $('#addNew').modal('show');
        },

    },

    created() {
        this.loadUsers();
    },
}
</script>
