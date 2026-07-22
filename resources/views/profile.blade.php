@extends('admin-lte/app')

@section('title', 'Detail Profile')

@section('content')

<style>
.profile-wrap{
    padding:20px;
    font-family:'Plus Jakarta Sans',sans-serif;
}

.profile-grid{
    display:grid;
    grid-template-columns:320px 1fr;
    gap:24px;
}

.profile-card,
.edit-card{
    background:#fff;
    border-radius:20px;
    box-shadow:0 4px 20px rgba(0,0,0,.05);
    overflow:hidden;
}

.profile-banner{
    height:90px;
    background:linear-gradient(135deg,#0f1f5c,#2563eb);
}

.profile-body{
    padding:0 24px 24px;
    margin-top:-45px;
    text-align:center;
}

.profile-avatar{
    width:90px;
    height:90px;
    border-radius:50%;
    border:4px solid #fff;
    object-fit:cover;
    background:#2563eb;
    margin:auto;
}

.profile-avatar-text{
    width:90px;
    height:90px;
    border-radius:50%;
    border:4px solid #fff;
    background:#2563eb;
    color:#fff;
    font-size:34px;
    font-weight:800;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:auto;
}

.profile-name{
    font-size:20px;
    font-weight:800;
    margin-top:14px;
    color:#0f172a;
}

.profile-role{
    display:inline-block;
    margin-top:6px;
    padding:6px 14px;
    border-radius:999px;
    background:#eff6ff;
    color:#2563eb;
    font-size:12px;
    font-weight:700;
}

.info-list{
    margin-top:24px;
    display:flex;
    flex-direction:column;
    gap:12px;
}

.info-item{
    background:#f8fafc;
    border-radius:12px;
    padding:14px;
    text-align:left;
}

.info-label{
    font-size:11px;
    color:#94a3b8;
    text-transform:uppercase;
    font-weight:700;
}

.info-value{
    font-size:14px;
    font-weight:700;
    color:#0f172a;
    margin-top:3px;
}

.edit-header{
    padding:22px 24px;
    border-bottom:1px solid #f1f5f9;
}

.edit-header h4{
    margin:0;
    font-size:18px;
    font-weight:800;
}

.edit-body{
    padding:24px;
}

.form-group label{
    font-size:13px;
    font-weight:700;
    color:#475569;
}

.form-control{
    border-radius:12px !important;
    height:46px;
}

.save-btn{
    background:linear-gradient(135deg,#0f1f5c,#2563eb);
    border:none;
    color:#fff;
    padding:12px 24px;
    border-radius:12px;
    font-weight:700;
}

.save-btn:hover{
    opacity:.9;
}

.preview-wrap{
    display:flex;
    align-items:center;
    gap:20px;
    margin-bottom:24px;
}

.preview-avatar{
    width:80px;
    height:80px;
    border-radius:50%;
    object-fit:cover;
    background:#2563eb;
}

@media(max-width:900px){
    .profile-grid{
        grid-template-columns:1fr;
    }
}
</style>

<div class="profile-wrap">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="profile-grid">

        {{-- LEFT --}}
        <div class="profile-card">

            <div class="profile-banner"></div>

            <div class="profile-body">

                @if(auth()->user()->foto)
                    <img src="{{ asset('storage/' . auth()->user()->foto) }}"
                         class="profile-avatar"
                         id="mainPreview">
                @else
                    <div class="profile-avatar-text" id="mainPreviewText">
                        {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                    </div>
                @endif

                <div class="profile-name">
                    {{ auth()->user()->name }}
                </div>

                <div class="profile-role">
                {{ ucfirst(auth()->user()->getRoleNames()->first()) }}
                </div>

                <div class="info-list">

                    <div class="info-item">
                        <div class="info-label">Email</div>
                        <div class="info-value">
    {{ ucfirst(auth()->user()->getRoleNames()->first()) }}
</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Role</div>
                        <div class="info-value">
                            {{ ucfirst(auth()->user()->role) }}
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Bergabung</div>
                        <div class="info-value">
                            {{ auth()->user()->created_at->format('d F Y') }}
                        </div>
                    </div>

                </div>

            </div>
        </div>

        {{-- RIGHT --}}
        <div class="edit-card">

            <div class="edit-header">
                <h4>Edit Profile</h4>
            </div>

            <div class="edit-body">

                <form action="{{ route('profile.update') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    <div class="preview-wrap">

                        @if(auth()->user()->foto)
                            <img src="{{ asset('storage/' . auth()->user()->foto) }}"
                                 class="preview-avatar"
                                 id="previewImage">
                        @else
                            <div class="profile-avatar-text preview-avatar"
                                 id="previewText"
                                 style="font-size:28px;">
                                {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                            </div>

                            <img id="previewImage"
                                 class="preview-avatar"
                                 style="display:none;">
                        @endif

                        <div>
                            <input type="file"
                                   name="foto"
                                   id="fotoInput"
                                   class="form-control">
                        </div>

                    </div>

                    <div class="form-group mb-3">
                        <label>Nama Lengkap</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ auth()->user()->name }}">
                    </div>

                    <div class="form-group mb-4">
                        <label>Email</label>
                        <input type="email"
                               class="form-control"
                               value="{{ auth()->user()->email }}"
                               disabled>
                    </div>

                    <button type="submit" class="save-btn">
                        Simpan Perubahan
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<script>
document.getElementById('fotoInput').addEventListener('change',function(e){

    const file = e.target.files[0];

    if(file){

        const reader = new FileReader();

        reader.onload = function(ev){

            let previewImage = document.getElementById('previewImage');

            previewImage.src = ev.target.result;
            previewImage.style.display = 'block';

            let previewText = document.getElementById('previewText');

            if(previewText){
                previewText.style.display = 'none';
            }
        }

        reader.readAsDataURL(file);
    }

});
</script>

@endsection