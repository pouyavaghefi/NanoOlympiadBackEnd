<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <form action="{{ route('adm.pgs.topmenu.trans') }}" method="POST">
            @csrf

            @php($counter = 0)
            @foreach ($menuItems as $index => $menuItem)
                <!-- Hidden input for menu_item_id -->
                <input type="hidden" name="menu_item_id[{{ $index }}]" value="{{ $menuItem->id }}">

                <div class="form-group mb-3">
                    <label for="menu_item_label_{{ $index }}">Menu Item {{ ++$counter }}:</label>
                    <input type="text" class="form-control" id="menu_item_label_{{ $index }}"
                           name="menu_item_label[{{ $index }}]"
                           value="{{ $menuItem->label }}"
                           disabled="disabled">
                </div>

                <div class="form-group mb-3">
                    <label for="menu_item_translate_name_{{ $index }}">
                        {{ optional($menuItem->showTrans('en'))->translate_name ?? '' }}
                    </label>
                    <input type="text" class="form-control" id="menu_item_translate_name_{{ $index }}"
                           name="menu_item_translate_name[{{ $index }}]"
                           value="{{ optional($menuItem->showTrans('en'))->translate_name ?? '' }}"
                           placeholder="Translate Name">
                </div>

                <!-- Add select for language -->
                <div class="form-group mb-3">
                    <label for="language_{{ $index }}">Language:</label>
                    <select class="form-control" id="language_{{ $index }}" name="language[{{ $index }}]">
                        @foreach (\App\Models\Language::all() as $language)
                            <option value="{{ $language->code }}"
                                    {{ optional($menuItem->showTrans($language->code))->language_code == $language->code ? 'selected' : '' }}>
                                {{ $language->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="menu_item_translate_description_{{ $index }}">
                        {{ optional($menuItem->showTrans('en'))->translate_description ?? '' }}
                    </label>
                    <input type="text" class="form-control" id="menu_item_translate_description_{{ $index }}"
                           name="menu_item_translate_description[{{ $index }}]"
                           value="{{ optional($menuItem->showTrans('en'))->translate_description ?? '' }}"
                           placeholder="Translate Description">
                </div>

                <hr>
            @endforeach

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save Translations</button>
            </div>
        </form>

        <hr>
        <br>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Menu Item (English)</th>
                @foreach ($languages2 as $language)
                    <th>{{ $language->name }} Translation</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach ($itemsMenu as $index => $menu)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $menu->label }}</td>

                    @foreach ($languages2 as $lang)
                            <?php
                            $translation = optional($menu->showTrans($lang->code))->translate_name;
                            ?>
                        <td>
                            {{ $translation ?? '' }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
