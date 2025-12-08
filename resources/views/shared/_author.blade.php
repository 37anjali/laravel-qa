<span class="text-gray-500 text-sm">{{ $label . " " . $model->created_date }}</span>
                                <div class="flex items-center justify-end mt-2 gap-2">
                                    <img src="{{$model->user->avatar }}" class="w-10 h-10 rounded-full">
                                    <a href="{{$model->user->url }}" class="text-blue-600 font-medium">
                                        {{$model->user->name }}
                                    </a>
                                </div>