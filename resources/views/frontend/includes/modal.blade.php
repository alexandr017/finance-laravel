<div class="modal fade" id="formModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body text-center"></div>
    </div>
  </div>
</div>
<div class="modal fade" id="callMe" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body text-center">
		<form class="form" id="callMeForm_">
		    <div class="form-group text-left">
		        <label for="c_name"><i class="red">*</i> Ваше имя:</label>
		        <input type="text" name="name" class="form-control" id="c_name" required>
		    </div>
		    <div class="form-group text-left">
		        <label for="c_hone"><i class="red">*</i> Телефон:</label>
		        <input type="number" name="phone"  class="form-control" id="c_hone" required>
		    </div>
		    <button type="submit" class="form-btn1">Отправить</button>
		</form>

      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="CardComplaint" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="new-select width-100" id="CardComplaintSelect">
                    <b class="active-element" data-val="0">Выберите тип жалобы</b>
                    <div class="icon-right bottom"></div>
                    <div class="hidden-elements">
                        <span class="line" data-val="1">Двойные списания</span>
                        <span class="line" data-val="2">Долгая верификация</span>
                        <span class="line" data-val="3">Займы на чужие данные</span>
                        <span class="line" data-val="4">Навязчивая реклама</span>
                        <span class="line" data-val="5">Навязывание услуг</span>
                        <span class="line" data-val="6">Предварительное одобрение и отказ</span>
                        <span class="line" data-val="7">Разглашение информации 3 лицам</span>
                        <span class="line" data-val="8">Снятие денег с карты</span>
                        <span class="line" data-val="9">Другое (описать подробно)</span>
                    </div>
                    <i></i>
                </div>
                <textarea class="form-control display_none" name="CardComplaintText" id="CardComplaintText"></textarea>
                <button class="form-btn1 pull-right">Отправить</button>

            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
