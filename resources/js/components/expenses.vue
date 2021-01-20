<template>
<div class="container">

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">قائمة المصروفات</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">اضافة مصروفات<i class="fas fa-user-plus fa-fw"></i></button>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>الرقم التعريفى</th>
                                    <th>اسم المبيعات</th>
                                    <th>السعر</th>
                                    <th>تعديل</th>
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
                    <h5 class="modal-title" id="addNewLabel">{{ editmode?'تعديل المصروفات':'تسجيل المصروفات' }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-4">المصروفات :</label>
                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control" name="name" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4">السعر :</label>
                            <div class="col-md-8">
                                <input id="price" type="number" class="form-control" name="price" required>
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
            axios.get("api/expenses").then((res) => {
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
