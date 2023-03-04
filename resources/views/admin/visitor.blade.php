<div id="scroller-content" class="visitor-info-section">
    <table class="table table-bordered">
        @foreach ($visitor_option as $option)
        <tr><td>{{ $option['label'] }}</td><td>{{ $option['count'] }}</td></tr>
        @endforeach
    </table>
</div>