<button data-toggle="modal" data-target="#phoneComplaint" class="small-green-btn">Пожаловаться</button>
<?php global $phoneComplaintForm; ?>
@if ($phoneComplaintForm == null)
<div class="modal fade" id="phoneComplaint" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <form class="form" id="phoneComplaintForm">
                    <div class="form-group text-left">
                        <label for="phoneComplaintEmail">Ваш Email:</label>
                        <input class="form-control" type="email" id="phoneComplaintEmail" name="phoneComplaintEmail">
                    </div>
                    <div class="form-group text-left">
                        <label for="c_hone"><i class="red">*</i> Тип жалобы:</label>
                        <div class="new-select width-100" id="phoneComplaintSelect">
                            <b class="active-element" data-val="Нельзя дозвониться">Нельзя дозвониться</b>
                            <div class="icon-right bottom"></div>
                            <div class="hidden-elements">
                                <span class="line" data-val="Нельзя дозвониться">Нельзя дозвониться</span>
                                <span class="line" data-val="Номер указан неверно">Номер указан неверно</span>
                                <span class="line" data-val="Прочее">Прочее</span>
                            </div>
                            <i></i>
                        </div>
                    </div>
                    <div class="form-group text-left" id="phoneComplaintTextWrap">
                        <label for="phoneComplaintText">Комментарий:</label>
                        <textarea class="form-control" id="phoneComplaintText" name="phoneComplaintText"></textarea>
                    </div>
                    <button type="submit" class="form-btn1">Отправить</button>
                </form>
            </div>

        </div>
    </div>
</div>
<?php $phoneComplaintForm = true; ?>
@endif
