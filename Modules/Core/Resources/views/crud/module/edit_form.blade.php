{!! form_start($form) !!}
<div class="row">
    @foreach($show_fields as $panelName => $panel)
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="row">
                @foreach($panel as $fieldName => $options)

                    @if(!isset($options['hide_in_form']))
                        <div class="{{ isset($options['col-class']) ? $options['col-class'] : 'col-lg-6 col-md-6 col-sm-6 col-xs-6' }}">
                            {!! form_row($form->{$fieldName}) !!}
                        </div>
                    @endif

                @endforeach
            </div>
        </div>
    @endforeach
</div>
{!! form_end($form, $renderRest = true) !!}
