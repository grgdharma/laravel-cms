<div>
    <select id="visitor-option" > 
        <option value="All"> ALL </option>
        @foreach ($visitor_option as $option)
        <option value="{{ $option['value'] }}"> {{ $option['label'] }} </option> 
        @endforeach
    </select>
    <table class="table table-bordered">
        <tr>
            <th>Pages</th>
            <th>Count</th>
        </tr>
        @foreach ($visitor_option as $option)
        <tr><td>{{ $option['label'] }}</td><td>{{ getPageVisitorCount($option['value']) }}</td></tr>
        @endforeach
    </table>

</div>