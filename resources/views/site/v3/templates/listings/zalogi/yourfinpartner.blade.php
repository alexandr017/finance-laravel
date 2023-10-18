<div class="modal fade" id="yourfinpartnerModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="mod-title">Онлайн заявка на займ под залог</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-4" id="yourfinpartnerBody">
                <form class="form" id="yourfinpartnerForm">
                    <?php /*
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group text-left">
                                <label for="yf_last_name"><i class="red">*</i> Фамилия:</label>
                                <input type="text" name="yf_last_name" class="form-control" id="yf_last_name" required placeholder="Иванов">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group text-left">
                                <label for="yf_first_name"><i class="red">*</i> Имя:</label>
                                <input type="text" name="yf_first_name" class="form-control" id="yf_first_name" required placeholder="Иван">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group text-left">
                                <label for="yf_second_name"><i class="red">*</i> Отчество:</label>
                                <input type="text" name="yf_second_name" class="form-control" id="yf_second_name" required placeholder="Иванович">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group text-left">
                                <label for="yf_passport_serial">Серия паспорта:</label>
                                <input type="text" name="yf_passport_serial" class="form-control" id="yf_passport_serial" required placeholder="1234">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group text-left">
                                <label for="yf_passport_number">Номер паспорта:</label>
                                <input type="text" name="yf_passport_number" class="form-control" id="yf_passport_number" required placeholder="567890">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group text-left">
                                <label for="yf_phone"><i class="red">*</i> Телефон:</label>
                                <input type="number" name="yf_phone" class="form-control" id="yf_phone" required>
                            </div>
                        </div>
                    </div>
                    <div class="info">Все поля обязательны к заполнению.<br> Серия паспорта в формате 0000. Номер паспорта в формате 000000</div>

                    */ ?>

                    <div class="form-group text-left">
                        <label for="yf_first_name"><i class="red">*</i> Имя:</label>
                        <input type="text" name="yf_first_name" class="form-control" id="yf_first_name" required placeholder="Иван">
                    </div>

                    <div class="form-group text-left">
                        <label for="yf_phone"><i class="red">*</i> Телефон:</label>
                        <input type="number" name="yf_phone" class="form-control" id="yf_phone" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="form-btn1">Отправить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@if(Auth::id() == 92879)
@else

@endif