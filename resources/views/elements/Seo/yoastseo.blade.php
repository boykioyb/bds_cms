@section('css-yoast')
    <link rel="stylesheet" href="{{ asset('assets/yoastseo/yoast-seo.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/yoastseo/yoast-seo-custom.css') }}">
@endsection
@section('js')
    <script src="{{ asset('assets/yoastseo/yoastseo-reviewer-bundle.js') }}"></script>

    <script>
        window.onload = function () {
            var yoastseoReviewer = new YoastseoReviewer({
                baseUrl: "{{ URL::to('/') }}/",
                selectorName: {
                    locale: "locale",
                    metaTitle: "SeoTitle",
                    metaDescription: "SeoDescs",
                    urlPath: "url_slug",
                    title: "name_slug",
                    description: "SeoDesc",
                    snippet: "snippet",
                    keyword: "keywords",
                    refreshAnalysis: "refresh-analysis"
                },
                targetSelectorName: {
                    output: "output",
                    contentOutput: "contentOutput"
                }
            });

            // console.log(yoastseoReviewer);
        };
    </script>
@endsection
<div class="m-content">

    <div class="m-portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
                    <h3 class="m-portlet__head-text">
                        Yoast SEO
                    </h3>
                </div>
            </div>
        </div>

        <!--begin::Form-->
        <div class="m-portlet__body">
            <div class="form-group m-form__group row">
                <div class="col-md-1" style="padding-left: 20px">
                    <button class="btn btn-primary" id="refresh-analysis"><i class="fa fa-refresh"></i>
                        <span>Làm mới</span>
                    </button>
                </div>
                <div class="col-md-4">
                    <div id="overallScore" class="overallScore">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 500 500"
                             enable-background="new 0 0 500 500" xml:space="preserve" width="34" height="34">
                            <g id="BG">
                            </g>
                            <g id="BG_dark">
                            </g>
                            <g id="bg_light">
                                <path fill="#5B2942" d="M415,500H85c-46.8,0-85-38.2-85-85V85C0,38.2,38.2,0,85,0h330c46.8,0,85,38.2,85,85v330
                                      C500,461.8,461.8,500,415,500z"/>
                                <path fill="none" stroke="#7EADB9" stroke-width="17" stroke-miterlimit="10" d="M404.6,467H95.4C61.1,467,33,438.9,33,404.6V95.4
                                      C33,61.1,61.1,33,95.4,33h309.2c34.3,0,62.4,28.1,62.4,62.4v309.2C467,438.9,438.9,467,404.6,467z"/>
                            </g>
                            <g id="Layer_2">
                                <circle id="score_circle_shadow" fill="#77B227" cx="250" cy="250" r="155"/>
                                <path id="score_circle" fill="#9FDA4F"
                                      d="M172.5,384.2C98.4,341.4,73,246.6,115.8,172.5S253.4,73,327.5,115.8"/>
                                <g>
                                    <g>
                                        <g display="none">
                                            <path display="inline" fill="#FEC228"
                                                  d="M668,338.4c-30.4,0-55-24.6-55-55s24.6-55,55-55"/>
                                            <path display="inline" fill="#8BDA53"
                                                  d="M668,215.1c-30.4,0-55-24.6-55-55s24.6-55,55-55"/>
                                            <path display="inline" fill="#FF443D"
                                                  d="M668,461.7c-30.4,0-55-24.6-55-55s24.6-55,55-55"/>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                </div>
                <br/>
                <div class="col-lg-12">
                    <form id="snippetForm" class="snippetForm m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                        <label class="col-form-label" style="padding-left: 20px">Snippet Preview</label>
                        <div id="snippet" class="output">

                        </div>
                        <input type="hidden" value="vi" id="locale"/>
                    </form>
                </div>
                <div class="col-lg-12">
                    <div id="output-container" class="output-container" style="padding-left: 20px">
                        <p>This is what the page might look like on a Google search result page.</p>

                        <p>Edit the SEO title and meta description by clicking the title and meta description!</p>
                        <h2>SEO assessments</h2>
                        <div id="output" class="output">

                        </div>
                        <h2>Content assessments</h2>
                        <div id="contentOutput" class="output">

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

