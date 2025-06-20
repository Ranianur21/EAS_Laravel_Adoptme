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
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property string|null $status
 * @property int|null $hewan_id
 * @property string|null $alasan
 * @property string|null $path_surat_pernyataan
 * @property-read \App\Models\Hewan|null $hewan
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adopsi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adopsi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adopsi query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adopsi whereAlasan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adopsi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adopsi whereHewanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adopsi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adopsi wherePathSuratPernyataan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adopsi whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Adopsi whereUserId($value)
 */
	class Adopsi extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nama
 * @property string $jenis
 * @property int $usia
 * @property string $jenis_kelamin
 * @property string|null $deskripsi
 * @property string|null $gambar
 * @property string|null $status
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Adopsi> $adopsi
 * @property-read int|null $adopsi_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hewan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hewan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hewan query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hewan tersedia()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hewan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hewan whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hewan whereGambar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hewan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hewan whereJenis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hewan whereJenisKelamin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hewan whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hewan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hewan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hewan whereUsia($value)
 */
	class Hewan extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $role
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $alamat
 * @property int|null $umur
 * @property string|null $pekerjaan
 * @property string|null $no_telp
 * @property string|null $path_foto_ktp
 * @property string|null $remember_token
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Adopsi> $adopsi
 * @property-read int|null $adopsi_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Adopsi> $adopsiPengajuan
 * @property-read int|null $adopsi_pengajuan_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereNoTelp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePathFotoKtp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePekerjaan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUmur($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

