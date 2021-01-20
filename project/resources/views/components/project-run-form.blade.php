<form method="post" action="{{ $action }}">
    @csrf
    <div class="card mt-3">
        <div class="card-body row">
            <div class="col-2" style="height: 60px;">
                <button type="submit" class="btn btn-primary" @if($activeCondition) disabled @endif>
                    <h2 style="color: white;">Run Project</h2>
                </button>
            </div>
            <div class="col">
                <input type="text"
                       placeholder="Command line arguments..."
                       class="form-control"
                       name="args"
                       value="@if(session()->has('args')) {{ session()->get('args') }} @endif"/>
            </div>
        </div>
    </div>
    <textarea placeholder="Standard input..."
              spellcheck="false"
              class="form-control"
              rows="1"
              name="stdin">@if(session()->has('stdin')) {{ session()->get('stdin') }} @endif</textarea>
</form>
