<div class="form-group  m-form__group row">
    <h2>Dành cho Seo</h2>
</div>
<div class="form-group m-form__group row">
    <label class="col-lg-2 col-form-label">Meta Tilte:</label>
    <div class="col-lg-8">
        <input id="SeoTitle" type="text" class="form-control m-input" name="meta_title"
               placeholder="Nhập tiêu đề"
               value="{{ isset($data->meta_title) && !empty($data->meta_title) ? $data->meta_title : '' }}">
    </div>
</div>
<div class="form-group m-form__group row">
    <label class="col-lg-2 col-form-label">Meta Description:</label>
    <div class="col-lg-8">
    <textarea id="SeoDescs" class="form-control m-input meta_description"
              name="meta_description"
              placeholder="Nhập mô tả">{{ isset($data->meta_description) && !empty($data->meta_description) ? $data->meta_description : '' }}</textarea>
    </div>
</div>
<div class="form-group m-form__group row">
    <label class="col-lg-2 col-form-label">Meta Keywords:</label>
    <div class="col-lg-8">
        <input id="keywords" type="text" class="form-control m-input" name="meta_keyword"
               placeholder="Nhập tiêu đề"
               value="{{ isset($data->meta_keyword) && !empty($data->meta_keyword) ? $data->meta_keyword : '' }}">
        <span
            class="m-form__help">Cách nhau bởi dấu , (VD: a,b).</span>
    </div>
</div>
