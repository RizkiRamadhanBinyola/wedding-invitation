<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $invitation_id
 * @property string $path
 * @property string|null $caption
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Invitation $invitation
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereCaption($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereInvitationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereUpdatedAt($value)
 */
	class Gallery extends \Eloquent {}
}l

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $invitation_id
 * @property string $nama_pengirim
 * @property string $isi_ucapan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Invitation $invitation
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Greeting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Greeting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Greeting query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Greeting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Greeting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Greeting whereInvitationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Greeting whereIsiUcapan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Greeting whereNamaPengirim($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Greeting whereUpdatedAt($value)
 */
	class Greeting extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $theme_id
 * @property string $slug
 * @property string $nama_wanita
 * @property string $nama_pria
 * @property string $ortu_wanita
 * @property string $ortu_pria
 * @property string $anak_ke
 * @property \Illuminate\Support\Carbon $tanggal
 * @property string $lokasi
 * @property string $no_telp
 * @property string $email
 * @property string $waktu_akad
 * @property string $waktu_resepsi
 * @property string|null $no_rekening
 * @property string|null $instagram
 * @property string|null $musik
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Gallery> $galleries
 * @property-read int|null $galleries_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Greeting> $greetings
 * @property-read int|null $greetings_count
 * @property-read \App\Models\Theme $theme
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation draft()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation published()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation whereAnakKe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation whereInstagram($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation whereLokasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation whereMusik($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation whereNamaPria($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation whereNamaWanita($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation whereNoRekening($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation whereNoTelp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation whereOrtuPria($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation whereOrtuWanita($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation whereThemeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation whereWaktuAkad($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invitation whereWaktuResepsi($value)
 */
	class Invitation extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $preview
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Theme newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Theme newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Theme query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Theme whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Theme whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Theme whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Theme wherePreview($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Theme whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Theme whereUpdatedAt($value)
 */
	class Theme extends \Eloquent {}
}

namespace App\Models{
/**
 * Class User
 *
 * @method HasMany invitations()
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $role
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Invitation> $invitations
 * @property-read int|null $invitations_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User admins()
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User users()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

