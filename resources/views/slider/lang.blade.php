<div class="m-accordion m-accordion--default m-accordion--toggle-arrow check-lang" id="m_accordion_{{ $lang }}"
     role="tablist" data-lang='{{ $lang }}'>

    <!--begin::Item-->
    <div class="m-accordion__item m-accordion__item--brand">
        <div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_{{ $lang }}_item_2_head"
             data-toggle="collapse"
             href="#m_accordion_{{ $lang }}_item_2_body" aria-expanded="false">
            <span class="m-accordion__item-title">{{ LANGUAGE[$lang] }}
                <span class="pull-right">
                <button class="btn btn-danger" onclick="removeLang('{{ $lang }}')" type="button"><i
                        class="fa fa-trash"></i></button>
            </span>
            </span>
        </div>
        <div class="m-accordion__item-body collapse" id="m_accordion_{{ $lang }}_item_2_body" role="tabpanel"
             aria-labelledby="m_accordion_{{ $lang }}_item_2_head" data-parent="#m_accordion_{{ $lang }}" style="">
            <div class="m-accordion__item-content">
                <div class="form-group m-form__group row">
                    <div class="col-lg-6 m-form__group-sub">
                        <label class="form-control-label">* Username:</label>
                        <input type="text" name="account_username"
                               class="form-control m-input" placeholder=""
                               value="nick.stone">
                        <span
                            class="m-form__help">Your username to login to your dashboard</span>
                    </div>
                    <div class="col-lg-6 m-form__group-sub">
                        <label class="form-control-label">* Password:</label>
                        <input type="password" name="account_password"
                               class="form-control m-input" placeholder="" value="qwerty">
                        <span class="m-form__help">Please use letters and at least one number and symbol</span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-6 m-form__group-sub">
                        <label class="form-control-label">* Username:</label>
                        <input type="text" name="account_username"
                               class="form-control m-input" placeholder=""
                               value="nick.stone">
                        <span
                            class="m-form__help">Your username to login to your dashboard</span>
                    </div>
                    <div class="col-lg-6 m-form__group-sub">
                        <label class="form-control-label">* Password:</label>
                        <input type="password" name="account_password"
                               class="form-control m-input" placeholder="" value="qwerty">
                        <span class="m-form__help">Please use letters and at least one number and symbol</span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-6 m-form__group-sub">
                        <label class="form-control-label">* Username:</label>
                        <input type="text" name="account_username"
                               class="form-control m-input" placeholder=""
                               value="nick.stone">
                        <span
                            class="m-form__help">Your username to login to your dashboard</span>
                    </div>
                    <div class="col-lg-6 m-form__group-sub">
                        <label class="form-control-label">* Password:</label>
                        <input type="password" name="account_password"
                               class="form-control m-input" placeholder="" value="qwerty">
                        <span class="m-form__help">Please use letters and at least one number and symbol</span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-6 m-form__group-sub">
                        <label class="form-control-label">* Username:</label>
                        <input type="text" name="account_username"
                               class="form-control m-input" placeholder=""
                               value="nick.stone">
                        <span
                            class="m-form__help">Your username to login to your dashboard</span>
                    </div>
                    <div class="col-lg-6 m-form__group-sub">
                        <label class="form-control-label">* Password:</label>
                        <input type="password" name="account_password"
                               class="form-control m-input" placeholder="" value="qwerty">
                        <span class="m-form__help">Please use letters and at least one number and symbol</span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-6 m-form__group-sub">
                        <label class="form-control-label">* Username:</label>
                        <input type="text" name="account_username"
                               class="form-control m-input" placeholder=""
                               value="nick.stone">
                        <span
                            class="m-form__help">Your username to login to your dashboard</span>
                    </div>
                    <div class="col-lg-6 m-form__group-sub">
                        <label class="form-control-label">* Password:</label>
                        <input type="password" name="account_password"
                               class="form-control m-input" placeholder="" value="qwerty">
                        <span class="m-form__help">Please use letters and at least one number and symbol</span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-6 m-form__group-sub">
                        <label class="form-control-label">* Username:</label>
                        <input type="text" name="account_username"
                               class="form-control m-input" placeholder=""
                               value="nick.stone">
                        <span
                            class="m-form__help">Your username to login to your dashboard</span>
                    </div>
                    <div class="col-lg-6 m-form__group-sub">
                        <label class="form-control-label">* Password:</label>
                        <input type="password" name="account_password"
                               class="form-control m-input" placeholder="" value="qwerty">
                        <span class="m-form__help">Please use letters and at least one number and symbol</span>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <div class="col-lg-6 m-form__group-sub">
                        <label class="form-control-label">* Username:</label>
                        <input type="text" name="account_username"
                               class="form-control m-input" placeholder=""
                               value="nick.stone">
                        <span
                            class="m-form__help">Your username to login to your dashboard</span>
                    </div>
                    <div class="col-lg-6 m-form__group-sub">
                        <label class="form-control-label">* Password:</label>
                        <input type="password" name="account_password"
                               class="form-control m-input" placeholder="" value="qwerty">
                        <span class="m-form__help">Please use letters and at least one number and symbol</span>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!--end::Item-->
</div>
    <script>
        function removeLang(lang_code) {
            $('#m_accordion_' + lang_code).remove();
        }
    </script>

