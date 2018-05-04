<div class="tab-pane" id="notes" role="tabpanel" aria-expanded="true">
    <form method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <input type="hidden" name="id" value="{{ $data['member']->id }}" >
            <label class="form-control-label">Notes:</label>
            <textarea class="form-control" name="notes">{{ $data['member']['notes'] }}</textarea>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div class="col-md-3">&nbsp;</div>
                <div class="col-md-3 pull-right">
                    <input type="submit" name="submit" class="btn btn-primary btn-block" value="Update">
                </div>
                <div class="col-md-3">&nbsp;</div>
            </div>
        </div>
    </form>
</div>