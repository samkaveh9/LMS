<div class="col-12 bg-white margin-bottom-15 border-radius-3">
    <p class="box__title">سرفصل ها</p>
    <form action="{{ route('seasons.store',$course->slug) }}" method="post" class="padding-30">
        @csrf
        <x-input type="text" name="title" placeholder="عنوان سرفصل" class="text" />
        <x-input type="text" name="number" placeholder="شماره سرفصل" class="text" />
        <button class="btn btn-webamooz_net">اضافه کردن</button>
    </form>
    <div class="table__box padding-30">
        <table class="table">
            <thead role="rowgroup">
            <tr role="row" class="title-row">
                <th class="p-r-90">شناسه</th>
                <th>عنوان فصل</th>
                <th>وضعیت سر فصل</th>
                <th>وضعیت تایید</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($course->seasons as $season)
                <tr role="row" class="">
                    <td><a href="">{{ $season->id }}</a></td>
                    <td><a href="">{{ $season->title }}</a></td>
                    <td class="status">@lang($season->status)</td>
                    <td class="confirmation_status">@lang($season->confirmation_status)</td>
                    <td>
                        <a href="{{ route('seasons.edit',$season->id) }}" class="item-edit mlg-15" title="ویرایش"></a>
                        @can(Samkaveh\RolePermission\Models\Permission::PERMISSION_MANAGE_COURSES)
                        @if ($season->status == \Samkaveh\Course\Models\Season::STATUS_OPENED)
                        <a href="" onclick="updateConfirmationStatus(event, '{{ route('seasons.lock', $season->id) }}',
                            'آیا از قفل کردن این آیتم اطمینان دارید؟' , 'قفل شده', 'status')"
                           class="item-lock mlg-15 text-error" title="قفل کردن">
                        </a>
                        @else
                        <a href="" onclick="updateConfirmationStatus(event, '{{ route('seasons.unlock', $season->id) }}',
                            'آیا از باز کردن این آیتم اطمینان دارید؟' , 'باز شده', 'status')"
                           class="item-lock mlg-15 text-success" title="باز کردن">
                        </a>
                        @endif
                        
                        <a href="" onclick="updateConfirmationStatus(event, '{{ route('seasons.accept', $season->id) }}',
                            'آیا از تایید این آیتم اطمینان دارید؟' , 'تایید شده')"
                           class="item-confirm mlg-15" title="تایید">
                        </a>
                        
                        <a href="" onclick="updateConfirmationStatus(event, '{{ route('seasons.reject', $season->id) }}',
                            'آیا از رد این آیتم اطمینان دارید؟' ,'رد شده')"
                           class="item-reject mlg-15" title="رد">
                        </a>
                        <a href="" onclick="deleteItem(event, '{{ route('seasons.destroy',$season->id) }}')" class="item-delete"  title="حذف"></a>
                        @endcan
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>