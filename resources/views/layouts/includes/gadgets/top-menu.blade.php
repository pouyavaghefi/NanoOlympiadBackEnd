<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <form action="{{ route('adm.pgs.topmenu.info') }}" method="POST">
            @csrf
            @foreach ($menuItems as $index => $menuItem)
                <!-- New Menu Item -->
                <div class="card mb-3">
                    <div class="card-header">
                        Add New Menu Item
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="menu_items[{{ $index }}][id]" value="{{ $menuItem->id }}">

                        <!-- Label -->
                        <div class="form-group mb-3">
                            <label for="new_menu_item_label">Label</label>
                            <input type="text" class="form-control" id="new_menu_item_label"
                                   name="new_menu_item[label]"
                                   placeholder="Enter Label">
                        </div>

                        <!-- Link -->
                        <div class="form-group mb-3">
                            <label for="new_menu_item_url">Link</label>
                            <input type="text" class="form-control" id="new_menu_item_url"
                                   name="new_menu_item[url]"
                                   placeholder="Enter Link">
                        </div>

                        <!-- Icon -->
                        <div class="form-group mb-3">
                            <label for="new_menu_item_icon">Icon</label>
                            <input type="text" class="form-control" id="new_menu_item_icon"
                                   name="new_menu_item[icon]"
                                   placeholder="Enter Icon Class (e.g., fas fa-home)">
                        </div>

                        <!-- Priority -->
                        <div class="form-group mb-3">
                            <label for="new_menu_item_priority">Priority</label>
                            <input type="number" class="form-control" id="new_menu_item_priority"
                                   name="new_menu_item[priority]"
                                   placeholder="Enter Priority">
                        </div>

                        <!-- Parent Menu Item -->
                        <div class="form-group mb-3">
                            <label for="new_menu_item_parent_id">Parent Menu Item</label>
                            <select class="form-control" id="new_menu_item_parent_id"
                                    name="new_menu_item[parent_id]">
                                <option value="">None (Top-Level)</option>
                                @foreach ($menuHierarchy as $parent)
                                    <option value="{{ $parent->id }}">
                                        {{ str_repeat('--', $parent->level) }} {{ $parent->label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="form-group mb-3">
                            <label for="new_menu_item_is_active">Active</label>
                            <select class="form-control" id="new_menu_item_is_active"
                                    name="new_menu_item[is_active]">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        Menu Item {{ $index + 1 }}
                    </div>
                    <div class="card-body">
                        <!-- Label -->
                        <div class="form-group mb-3">
                            <label for="menu_item_{{ $index + 1 }}_label">Label</label>
                            <input type="text" class="form-control" id="menu_item_{{ $index + 1 }}_label"
                                   name="menu_items[{{ $index }}][label]"
                                   placeholder="Enter Label"
                                   value="{{ old('menu_items.' . $index . '.label', $menuItem->label) }}">
                        </div>

                        <!-- Link -->
                        <div class="form-group mb-3">
                            <label for="menu_item_{{ $index + 1 }}_url">Link</label>
                            <input type="text" class="form-control" id="menu_item_{{ $index + 1 }}_url"
                                   name="menu_items[{{ $index }}][url]"
                                   placeholder="Enter Link"
                                   value="{{ old('menu_items.' . $index . '.url', $menuItem->url) }}">
                        </div>

                        <!-- Icon -->
                        <div class="form-group mb-3">
                            <label for="menu_item_{{ $index + 1 }}_icon">Icon</label>
                            <input type="text" class="form-control" id="menu_item_{{ $index + 1 }}_icon"
                                   name="menu_items[{{ $index }}][icon]"
                                   placeholder="Enter Icon Class (e.g., fas fa-home)"
                                   value="{{ old('menu_items.' . $index . '.icon', $menuItem->icon) }}">
                        </div>

                        <!-- Priority -->
                        <div class="form-group mb-3">
                            <label for="menu_item_{{ $index + 1 }}_priority">Priority</label>
                            <input type="number" class="form-control" id="menu_item_{{ $index + 1 }}_priority"
                                   name="menu_items[{{ $index }}][priority]"
                                   placeholder="Enter Priority"
                                   value="{{ old('menu_items.' . $index . '.priority', $menuItem->priority) }}">
                        </div>

                        <!-- Parent Menu Item -->
                        <div class="form-group mb-3">
                            <label for="menu_item_{{ $index + 1 }}_parent_id">Parent Menu Item</label>
                            <select class="form-control" id="menu_item_{{ $index + 1 }}_parent_id"
                                    name="menu_items[{{ $index }}][parent_id]">
                                <option value="">None (Top-Level)</option>
                                @foreach ($menuHierarchy as $parent)
                                    <option value="{{ $parent->id }}"
                                            {{ old('menu_items.' . $index . '.parent_id', $menuItem->parent_id) == $parent->id ? 'selected' : '' }}>
                                        {{ str_repeat('--', $parent->level) }} {{ $parent->label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="form-group mb-3">
                            <label for="menu_item_{{ $index + 1 }}_is_active">Active</label>
                            <select class="form-control" id="menu_item_{{ $index + 1 }}_is_active"
                                    name="menu_items[{{ $index }}][is_active]">
                                <option value="1" {{ old('menu_items.' . $index . '.is_active', $menuItem->is_active) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('menu_items.' . $index . '.is_active', $menuItem->is_active) == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save Menu</button>
            </div>
        </form>

    </div>
</div>
