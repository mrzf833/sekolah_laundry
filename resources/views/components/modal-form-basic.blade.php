<div class="modal fade" id="{{ $id_modal }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $id_title ?? '' }}">{{ $text_title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <form action="{{ $action }}" enctype="multipart/form-data" method="POST" id="{{ $form_id ?? '' }}">
                @csrf
                {{ $method ?? '' }}
                <div class="modal-body">
                    {{ $content_modal }}
                </div>
                <div class="modal-footer">
                    @if (isset($content_footer))
                        {{ $content_footer }}
                    @else
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>