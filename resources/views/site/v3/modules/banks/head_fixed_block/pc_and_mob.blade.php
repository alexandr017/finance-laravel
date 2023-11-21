<div class="fixed-company">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-8">
                <img width="150" src="{{$bank->logo}}" alt="{{$bank->name}}">
                <span class="zaym-name">{{$bankTopCard->title}}</span>
            </div>
            <div class="col-md-3 col-sm-4">
                <?php if($bank->status) {
                    $company_link = ($bankTopCard->link_type == 1) ? $bankTopCard->link_1 : $bankTopCard->link_2;
                } else {
                    $company_link = $bankTopCard->link_2;
                }
                $goal = ($bank->category_id == 1) ? 'zaim-reviews' : 'orgbut';
                ?>
                <a data-id="{{$bank->id}}" class="hdl form-btn1" href="{{$company_link}}" target="_blank"> Оформить</a>
            </div>
        </div>
    </div>
</div>
