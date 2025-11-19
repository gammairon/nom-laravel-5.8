<table class="mfo_contact_list">
    <tbody>
        @foreach($mfos as $mfo)
            <tr>
                <td>Кредит в {{$mfo->name}}</td>
                <td>
                    @if(!empty($mfo->address))
                        <p><strong>Адрес</strong>: {{$mfo->address}}</p>
                    @endif

                    @if(!empty($mfo->email))
                        <p><strong>Email</strong>: <a href="mailto:{{$mfo->email}}">{{$mfo->email}}</a></p>
                    @endif

                    @if(!empty($mfo->phone))
                        <p><strong>Тел</strong>: {{$mfo->phone}}</p>
                    @endif

                    @if(!empty($mfo->work_time))
                        <p><strong>График работы</strong>: {{$mfo->work_time}}</p>
                    @endif

                    @if(!empty($mfo->nfs_license))
                        <p><strong>Лицензия Нацкомфинуслуг</strong>: {{$mfo->nfs_license}}</p>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>