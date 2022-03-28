<div class="row justify-content-center mb-3">
    @foreach($stats as $stat)
    <div class="col-md-3">
        <div class="dashcard shandow-sm">
            <x-orchid-icon path="{{$stat['icon']}}" class="icon-big" width="1.7em" height="1.7em" />
            <div class="dashcard__val">{{$stat['value']}}</div>
            <div class="dashcard__title">{{$stat['title']}}</div>
        </div>
    </div>
    @endforeach
</div>

<style>
    .dashcard {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: #fdfdfd;
        border-radius: 10px;
        height: 150px;
        width: 200px;
    }

    .dashcard__val {
        font-weight: bolder;
        font-size: 22px;
        color: #666;
        margin-top: 5px;
    }

    .dashcard__title {
        font-size: 15px;
        margin-top: 5px;
    }
</style>