<?php
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminFeatureController;
use App\Http\Controllers\Admin\System\FormHandlerController;
use App\Http\Controllers\Admin\Pages\LandingController;
use App\Http\Controllers\Admin\Pages\ContactController;
use App\Http\Controllers\Admin\Members\MembersCountryController;
use App\Http\Controllers\Admin\Users\NormalUsersController;
use App\Http\Controllers\Admin\Users\AdminUsersController;
use App\Http\Controllers\Admin\Users\SuperUsersController;
use App\Http\Controllers\Admin\Users\AdminProfileController;
use App\Http\Controllers\Admin\Courses\AdminCoursesController;
use App\Http\Controllers\Admin\Courses\CourseCategoriesController;
use App\Http\Controllers\Admin\Episodes\AdminEpisodesController;
use App\Http\Controllers\Admin\Teachers\AdminTeachersController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\Pages\LanguagesController;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Admin\Pages\TranslationController;
use App\Http\Controllers\Admin\Pages\WebPagesController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\Notifications\AdminNotificationController;
use App\Http\Middleware\RestrictIPAccess;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Mail\RegistrationEmail;

require __DIR__.'/auth.php';

Route::middleware(['auth',RestrictIPAccess::class])->name('adm.')->group(function () {
    Route::prefix('/system')->name('sys.')->group(function () {
        Route::get('/form-handler',[FormHandlerController::class,'index']);
    });

    Route::get('/admin-profile', [AdminProfileController::class, 'viewProfile'])->name('admin-profile');
    Route::get('/account-settings', [AdminProfileController::class, 'accSettings'])->name('account-settings');

    Route::prefix('/web-pages')->name('pgs.')->group(function () {
        Route::post('/upload-file/{directory}', [WebPagesController::class, 'uploadWallPaper'])->name('upload.wallpaper');

        Route::prefix('/dynamics')->name('dynamics.')->group(function () {
            Route::get('/', [WebPagesController::class, 'showAllDynamics'])->name('index');
            Route::get('/create', [WebPagesController::class, 'createNewDynamic'])->name('new');
        });

        Route::prefix('/statics')->name('statics.')->group(function () {
            Route::get('/', [WebPagesController::class, 'showAllStatics'])->name('index');
            Route::post('/store/', [WebPagesController::class, 'postStatic'])->name('store');
            Route::get('/edit/{id}', [WebPagesController::class, 'editStatic'])->name('edit');
            Route::put('/update/{id}', [WebPagesController::class, 'updateStatic'])->name('update');
            Route::get('/create', [WebPagesController::class, 'createStatic'])->name('create');
            Route::post('/store', [WebPagesController::class, 'storeStatic'])->name('store');
            Route::post('/file-browser/upload', [PagesController::class, 'uploadStaticPageImg'])->name('upload.img');
            Route::post('/file-browser/upload/{pageId}', [PagesController::class, 'uploadStaticPageImg'])->name('upload.img.edit');
            Route::put('/update/content/{id}', [WebPagesController::class, 'updateStaticContent'])->name('updateContent');
        });
    });

    Route::name('dash.')->group(function () {
        Route::get('/',[DashboardController::class,'index'])->name('index');
    });

    Route::prefix('courses')->name('crs.')->group(function () {
        Route::get('/all', [AdminCoursesController::class, 'allCourses'])->name('index');
        Route::get('/create', [AdminCoursesController::class, 'createNewCourse'])->name('create');
        Route::post('/create', [AdminCoursesController::class, 'storeNewCourse'])->name('store');
        Route::get('/edit/{id}', [AdminCoursesController::class, 'editCourse'])->name('edit');
        Route::put('/update/{id}', [AdminCoursesController::class, 'updateCourse'])->name('update');
        Route::get('/delete/image/{id}', [AdminCoursesController::class, 'deleteImage'])->name('deleteImage');
        Route::get('/delete/image/cover/{id}', [AdminCoursesController::class, 'deleteImage'])->name('deleteImageCover');
        Route::get('/delete/{id}', [AdminCoursesController::class, 'deleteCourse'])->name('remove');
        Route::get('/show/{id}', [AdminCoursesController::class, 'showCourse'])->name('show');

        Route::post('/quick-edit/{id}', [AdminCoursesController::class, 'quickEditTitle'])->name('quick-edit');
        Route::get('/change-status/{id}', [AdminCoursesController::class, 'changeStatus'])->name('change-status');

        Route::prefix('/episodes')->name('epi.')->group(function () {
            Route::get('/index', [AdminEpisodesController::class, 'indexEpisodes'])->name('allIndex');
            Route::get('/edit/{id}', [AdminEpisodesController::class, 'editEpisode'])->name('editEpi');
            Route::put('/update/{id}', [AdminEpisodesController::class, 'updateEpisode'])->name('updateEpi');
        });

        Route::prefix('/categories')->name('cats.')->group(function () {
            Route::get('/all', [CourseCategoriesController::class, 'showAllCats'])->name('index');
            Route::get('/create', [CourseCategoriesController::class, 'createNewCat'])->name('create');
            Route::post('/store', [CourseCategoriesController::class, 'storeNewCat'])->name('store');
            Route::get('/edit', [CourseCategoriesController::class, 'editCat'])->name('edit');
            Route::post('/update', [CourseCategoriesController::class, 'updateCat'])->name('update');
            Route::get('/delete', [CourseCategoriesController::class, 'destroyCat'])->name('remove');
            Route::get('/show/{id}', [CourseCategoriesController::class, 'showCat'])->name('show');
            Route::get('/{id}/courses', [CourseCategoriesController::class, 'relatedCourses'])->name('related.crs');
            Route::post('/quick-edit/{id}', [CourseCategoriesController::class, 'quickEditTitle'])->name('quick-edit');
            Route::get('/change-status/{id}', [CourseCategoriesController::class, 'changeStatus'])->name('change-status');
        });

        Route::prefix('courses/{course}')->group(function () {
            Route::get('/translate', [AdminCoursesController::class, 'translate'])->name('translate');
            Route::post('/translate/submit', [AdminCoursesController::class, 'submitTranslation'])->name('translate.submit');
            Route::get('/translate/{language}/edit', [AdminCoursesController::class, 'editTranslation'])->name('translate.edit');
            Route::patch('/translate/{language}/update', [AdminCoursesController::class, 'updateTranslation'])->name('translate.update');
            Route::delete('/translate/{language}/delete', [AdminCoursesController::class, 'deleteTranslation'])->name('translate.delete');
        });

        Route::prefix('{course_id}/episodes')->name('epi.')->group(function () {
            Route::get('/all', [AdminEpisodesController::class, 'allCourseEpisodes'])->name('index');
            Route::get('/create', [AdminEpisodesController::class, 'createNewEpisode'])->name('create');
            Route::post('/store', [AdminEpisodesController::class, 'storeNewEpisode'])->name('store');
            Route::get('/edit/{id}', [AdminEpisodesController::class, 'editEpisode'])->name('edit');
            Route::post('/update/{id}', [AdminEpisodesController::class, 'updateEpisode'])->name('update');
            Route::delete('/delete/{id}', [AdminEpisodesController::class, 'deleteEpisode'])->name('remove');
            Route::get('/view/{id}', [AdminEpisodesController::class, 'viewEpisode'])->name('view');
            Route::post('/quick-edit/{id}', [AdminEpisodesController::class, 'quickEditTitle'])->name('quick-edit');

            // New Routes
            Route::get('/download/{id}', [AdminEpisodesController::class, 'downloadEpisode'])->name('download');
            Route::get('/toggle-status/{id}', [AdminEpisodesController::class, 'toggleStatus'])->name('toggleStatus');
            Route::get('/stats/{id}', [AdminEpisodesController::class, 'episodeStats'])->name('stats');
        });
    });

    Route::prefix('academy')->name('aca.')->group(function () {
        Route::prefix('/representatives')->name('rep.')->group(function () {
            Route::get('/all',[AdminTeachersController::class,'index'])->name('index');
            Route::get('/create',[AdminTeachersController::class,'create'])->name('create');
            Route::post('/store',[AdminTeachersController::class,'store'])->name('store');
            Route::get('/edit/{id}',[AdminTeachersController::class,'edit'])->name('edit');
            Route::patch('/update/{id}',[AdminTeachersController::class,'update'])->name('update');
            Route::get('/delete/{id}',[AdminTeachersController::class,'destroy'])->name('delete');
            Route::get('/{id}/remove-file/{type}',[AdminTeachersController::class,'removeFile'])->name('removeFile');
        });

        Route::prefix('/members')->name('mem.')->group(function () {
            Route::get('/all',[MembersCountryController::class,'index'])->name('index');
            Route::get('/create',[MembersCountryController::class,'create'])->name('create');
            Route::post('/store',[MembersCountryController::class,'store'])->name('store');
            Route::get('/edit/{id}',[MembersCountryController::class,'edit'])->name('edit');
            Route::patch('/update/{id}',[MembersCountryController::class,'update'])->name('update');
            Route::get('/delete/{id}',[MembersCountryController::class,'destroy'])->name('delete');
            Route::post('/members-country/add-country', [MembersCountryController::class, 'addCountry']);
            Route::post('/members-country/update-status/{id}', [MembersCountryController::class, 'updateStatus']);
            Route::post('/members-country/update-flag/{id}', [MembersCountryController::class, 'updateFlag'])
                ->name('members-country.update-flag');
        });

        Route::prefix('/teachers')->name('tea.')->group(function () {
            Route::get('/all',[AdminTeachersController::class,'index'])->name('index');
            Route::get('/create',[AdminTeachersController::class,'create'])->name('create');
            Route::post('/store',[AdminTeachersController::class,'store'])->name('store');
            Route::get('/edit/{id}',[AdminTeachersController::class,'edit'])->name('edit');
            Route::patch('/update/{id}',[AdminTeachersController::class,'update'])->name('update');
            Route::get('/delete/{id}',[AdminTeachersController::class,'destroy'])->name('delete');
            Route::get('/{id}/remove-file/{type}',[AdminTeachersController::class,'removeFile'])->name('removeFile');
        });
    });

    Route::prefix('site')->name('site.')->group(function () {
        Route::get('/tags/create',[AdminFeatureController::class,'createTag'])->name('tags.create');
        Route::post('/tags/submit',[AdminFeatureController::class,'submitTag'])->name('tags.submit');
        Route::get('/tags/index',[AdminFeatureController::class,'indexTag'])->name('tags.index');

        Route::name('users.')->prefix('users')->group(function () {
            Route::get('/',[NormalUsersController::class,'index'])->name('index');
            Route::get('/conversations/{id}',[AdminFeatureController::class,'conversations'])->name('conversations');
            Route::get('/conversations/{user}/{conversation}',[AdminFeatureController::class,'customConversation'])->name('conversations.custom');
            Route::post('/conversations/{user}/{conversation}/send/reply',[AdminFeatureController::class,'sendReply'])->name('conversations.send.reply');
            Route::get('/create',[NormalUsersController::class,'create'])->name('create');
            Route::post('/store',[NormalUsersController::class,'store'])->name('store');
            Route::get('/edit',[NormalUsersController::class,'edit'])->name('edit');
            Route::patch('/update',[NormalUsersController::class,'update'])->name('update');
            Route::get('/remove/{id}',[NormalUsersController::class,'remove'])->name('remove');
            Route::delete('/destroy/',[NormalUsersController::class,'destroy'])->name('destroy');
            Route::get('/show/{id}',[NormalUsersController::class,'view'])->name('view');
            Route::post('/show/{id}',[NormalUsersController::class,'uploadAvatar'])->name('uploadAvatar');
            Route::delete('/show/{id}',[NormalUsersController::class,'destroyAvatar'])->name('deleteAvatar');
            Route::get('/internal-download-zip/{id}',[NormalUsersController::class,'requestZip'])->name('requestZip');
            Route::get('/internal-delete-all-files/{id}',[NormalUsersController::class,'deleteAllFiles'])->name('deleteAllFiles');
            Route::post('/upload-custom-member-photo-directly/{id}',[NormalUsersController::class,'uploadFile'])->name('uploadMemPhoto');
            Route::post('/user-files/{id}/rename', [NormalUsersController::class, 'renameUserFile'])->name('renameUserFile');
            Route::get('/{id}/download-pdf', [NormalUsersController::class, 'downloadPdf'])->name('downloadPdf');
            Route::post('/{id}/move-user-file', [NormalUsersController::class, 'moveUserFile'])->name('moveUserFile');
            Route::get('/user-files/soft-delete/{userId}/{fileName}', [NormalUsersController::class, 'softDelete'])->name('softDelete');
            Route::get('/user-files/restore/{userId}/{fileName}', [NormalUsersController::class, 'restore'])->name('restore');
            Route::post('/user-files/update-full-name/{id}', [NormalUsersController::class, 'updateFullName'])->name('updateFullName');

            Route::get('/send-message/{id}',[AdminFeatureController::class,'sendMessage'])->name('sendMessage');
            Route::post('/send-message/{id}',[AdminFeatureController::class,'submitSendMessage'])->name('sendMessage.submit');

            // routes/api.php
        });
        Route::name('admins.')->prefix('admins')->group(function () {
            Route::get('/',[AdminUsersController::class,'index'])->name('index');
            Route::get('/create',[AdminUsersController::class,'create'])->name('create');
            Route::post('/store',[AdminUsersController::class,'store'])->name('store');
            Route::get('/edit',[AdminUsersController::class,'create'])->name('edit');
            Route::patch('/update',[AdminUsersController::class,'update'])->name('update');
            Route::get('/remove/{id}',[AdminUsersController::class,'remove'])->name('remove');
            Route::delete('/destroy/{id}',[AdminUsersController::class,'destroy'])->name('destroy');
            Route::get('/show',[AdminUsersController::class,'view'])->name('view');
        });
        Route::name('supers.')->prefix('supers')->group(function () {
            Route::get('/',[SuperUsersController::class,'index'])->name('index');
            Route::post('/regenerate-existing-token',[SuperUsersController::class,'regenerateToken'])->name('regenerate-token');
        });
    });

    Route::name('pgs.')->group(function () {
        Route::get('/contact/info',[ContactController::class,'info'])->name('contact.info');
        Route::post('/contact/info',[ContactController::class,'updateContactInfo'])->name('contact.info.update');

        Route::get('/contact/messages',[ContactController::class,'messenger'])->name('contact.messenger');
        Route::post('/contact/messages',[ContactController::class,'updateMessenger'])->name('contact.messenger.update');

        Route::get('/contact/info/deleteCoverImage', [ContactController::class, 'deleteCoverImage'])->name('contact.info.deleteCoverImage');
        Route::get('/contact/info/deleteBoxImage', [ContactController::class, 'deleteBoxImage'])->name('contact.info.deleteBoxImage');

        Route::get('/landing/slider',[LandingController::class,'slider'])->name('slider.info');
        Route::post('/landing/slider',[LandingController::class,'sliderNew'])->name('slider.update');
        Route::get('/landing/slider/edit/{id}',[LandingController::class,'editSlider'])->name('slider.edit');
        Route::post('/landing/slider/update/{id}',[LandingController::class,'updateSlider'])->name('slider.update');
        Route::delete('/landing/slider/delete/{id}',[LandingController::class,'deleteSlider'])->name('slider.delete');
        Route::get('/landing/slider/view/{id}',[LandingController::class,'viewSlider'])->name('slider.view');

        Route::get('/landing/slider/translations',[LanguagesController::class,'translationsSlider'])->name('slider.trans');
        Route::post('/landing/slider/translations',[LanguagesController::class,'updateTranslationsSlider']);
        Route::delete('/landing/slider/translations/delete', [LanguagesController::class, 'deleteSliderTranslation'])->name('slider.trans.delete');

        Route::get('/landing/quick-contact-info',[LandingController::class,'quickContact'])->name('quick.contact.info');
        Route::post('/landing/quick-contact-info',[LandingController::class,'updateQuickContact']);

        Route::prefix('/landing/topmenu-navigation')->group(function () {
            Route::get('/',[LandingController::class,'topmenu'])->name('topmenu.info');
            Route::post('/',[LandingController::class,'updateTopMenu']);

            Route::get('/translations',[LanguagesController::class,'translationsTopMenu'])->name('topmenu.trans');
            Route::post('/translations',[LanguagesController::class,'updateTranslationsTopMenu']);
        });

        Route::get('/landing/call-to-action',[LandingController::class,'callToAction'])->name('call-to-action');
        Route::post('/landing/call-to-action',[LandingController::class,'updateCallToAction']);

        Route::get('/landing/features',[LandingController::class,'features'])->name('features.info');
        Route::post('/landing/features',[LandingController::class,'updateFeatures']);

        Route::get('/landing/features/translations',[LanguagesController::class,'featuresTranslations'])->name('features.trans');
        Route::post('/landing/features/translations',[LanguagesController::class,'updateFeaturesTranslations']);
        Route::delete('/landing/features/translations/{id}/remove',[LanguagesController::class,'removeFeatureTranslation'])->name('features.trans.delete');

        Route::get('/landing/aboutus',[LandingController::class,'aboutus'])->name('aboutus.info');
        Route::post('/landing/aboutus',[LandingController::class,'updateAboutUs']);

        Route::get('/landing/aboutus/translations',[LanguagesController::class,'aboutusTranslations'])->name('aboutus.trans');
        Route::post('/landing/aboutus/translations',[LanguagesController::class,'updateAboutusTranslations']);
        Route::delete('/landing/aboutus/translations/{id}/remove',[LanguagesController::class,'deleteAboutusTranslation'])->name('aboutus.trans.delete');

        Route::get('/landing/counter',[LandingController::class,'counter'])->name('counter.info');
        Route::post('/landing/counter',[LandingController::class,'updateCounter']);

        Route::get('/landing/gallery',[LandingController::class,'gallery'])->name('gallery.info');
        Route::post('/landing/gallery',[LandingController::class,'updateGallery']);

        Route::get('/landing/cta',[LandingController::class,'cta'])->name('cta.info');
        Route::post('/landing/cta',[LandingController::class,'updateCta']);

        Route::get('/landing/departments',[LandingController::class,'departments'])->name('departments.info');
        Route::post('/landing/departments',[LandingController::class,'updateDepartments']);

        Route::get('/landing/departments/translations',[LanguagesController::class,'translationsDepartments'])->name('departments.trans');
        Route::post('/landing/departments/translations',[LanguagesController::class,'updateTranslationsDepartments']);
        Route::delete('/landing/departments/translations/delete/{id}',[LanguagesController::class,'deleteTranslationDepartments'])->name('departments.trans.delete');

        Route::get('/landing/partners',[LandingController::class,'partners'])->name('partners.info');
        Route::post('/landing/partners',[LandingController::class,'updatePartners']);

        Route::get('/landing/footer',[LandingController::class,'footer'])->name('footer');
        Route::post('/landing/footer',[LandingController::class,'updateFooter']);

        Route::get('/landing/subscribers',[LandingController::class,'subscribers'])->name('subscribers');
        Route::post('/landing/subscribers',[LandingController::class,'updateSubscribers']);

        Route::get('/landing/priority',[LandingController::class,'priority'])->name('prior');
        Route::post('/landing/priority',[LandingController::class,'updatePriority']);
    });

    Route::prefix('settings')->name('set.')->group(function () {
        Route::get('/site-settings', [SettingsController::class, 'siteSettings'])->name('site');
        Route::post('/site-settings', [SettingsController::class, 'updateSiteSettings']);

        Route::get('/seo-settings', [SettingsController::class, 'siteSeo'])->name('seo');
        Route::post('/seo-settings', [SettingsController::class, 'updateSiteSeo']);

        Route::get('/admin-settings', [SettingsController::class, 'siteAdm'])->name('adm');
        Route::post('/admin-settings', [SettingsController::class, 'updateAdmSettings']);

        Route::get('/panel-settings', [SettingsController::class, 'sitePanel'])->name('panel');
        Route::post('/panel-settings', [SettingsController::class, 'updatePanelSettings']);

        Route::get('/user-settings', [SettingsController::class, 'siteUsr'])->name('usr');
        Route::post('/user-settings', [SettingsController::class, 'updateUsrSettings']);

        Route::get('/coming-settings', [SettingsController::class, 'comingSoon'])->name('soon');
        Route::post('/coming-settings', [SettingsController::class, 'updateComingSettings']);

        Route::prefix('languages')->name('langs.')->group(function () {
            Route::get('/arabic-settings', [LanguagesController::class, 'arabicSettings'])->name('ar');
            Route::post('/arabic-settings', [LanguagesController::class, 'updateArabicSettings']);

            Route::get('/german-settings', [LanguagesController::class, 'germanSettings'])->name('de');
            Route::post('/german-settings', [LanguagesController::class, 'updateGermanSettings']);

            Route::prefix('configurations')->name('cfg.')->group(function () {
                Route::get('/', [TranslationController::class, 'index'])->name('index');

                Route::post('/create/new', [TranslationController::class, 'storeNewLanguage'])->name('store');
                Route::get('/{id}/edit', [TranslationController::class, 'editExistingLanguage'])->name('edit');
                Route::post('/{id}/update', [TranslationController::class, 'updateExistingLanguage'])->name('update');
                Route::get('/{id}/delete', [TranslationController::class, 'destroyLanguage'])->name('destroy');
                Route::post('/toggle-status/{id}', [TranslationController::class, 'changeLanguageStatus'])->name('change-status');

                Route::prefix('localizations')->name('local.')->group(function () {
                    Route::post('/create/new', [TranslationController::class, 'storeNewLocalVar'])->name('store');
                    Route::get('/{id}/edit', [TranslationController::class, 'editExistingLocalVar'])->name('edit');
                    Route::post('/{id}/update', [TranslationController::class, 'updateExistingLocalVar'])->name('update');
                    Route::get('/{id}/delete', [TranslationController::class, 'destroyExistingLocalVar'])->name('destroy');
                    Route::post('/toggle-status/{id}', [TranslationController::class, 'changeLocalizationStatus'])->name('change-status');
                });
            });
        });
    });

    Route::name('notifs.')->prefix('notifications')->group(function () {
        Route::name('admin.')->prefix('admin')->group(function () {
            Route::get('/view/{id}',[AdminNotificationController::class,'view'])->name('view');
        });
    });
});

Route::get('/send-activation-link/{id}', function ($id) {
    $user = User::findOrFail($id);

    if ($user->is_active == 0 || is_null($user->email_verified_at)) {
        Mail::to($user->email)->send(new RegistrationEmail($user));

        Session::flash('sw_success', 'Activation Link was sent successfully!');
    }

    return redirect()->back()->withSuccess('Activation Link was sent successfully!');
})->name('send.activation.link');

Route::get('/change-user-status/{id}', function ($id) {
    $user = User::findOrFail($id);

    if ($user->is_active == 0) {
        $user->is_active = 1;
    }else{
        $user->is_active = 0;
    }

    if (is_null($user->email_verified_at)) {
        $user->email_verified_at = now();
    }else{
        $user->email_verified_at = null;
    }
    $user->save();

    return redirect()->back()->withSuccess('Status was changed successfully!');
})->name('change.status');

Route::get('/change-email-activation/{id}', function ($id) {
    $user = User::findOrFail($id);

    if (is_null($user->email_verified_at)) {
        $user->email_verified_at = now();
    }else{
        $user->email_verified_at = null;
    }
    $user->save();

    return redirect()->back()->withSuccess('Email Activation was changed successfully!');
})->name('change.activation');

Route::post('/logout-due-to-inactivity', function () {
    \Illuminate\Support\Facades\Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return response()->json(['status' => 'logged_out']);
})->middleware('auth');

Route::get('International Nanotechnology Olympiad', function () {
    return redirect('https://ino-official.org', 301); // 301 for permanent redirect
});
