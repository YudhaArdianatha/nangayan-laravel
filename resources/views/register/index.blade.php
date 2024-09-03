<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/auth.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>NangAyan | Register</title>
</head>

<body>
    <main>
        <div class="side">
            <section class="copy">
            </section>
        </div>
        <div class="content">
            <p class="home"><a href="/" class="text-decoration-none" style="color: #e0b973">X</a></p>
            <form action="/register" method="post">
                @csrf
                <section class="copy">
                    <h2 class="mb-3">Register Form</h2>
                    <div class="input-container text-start">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Example" value="{{ old('name') }}" autofocus required>
                        @error('name')
                            <div class="invalid-feedback text-start">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="form-wrapper">
                            <label for="email">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="CR7@example.com" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback text-start">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-wrapper">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" required>
                            @error('password')
                                <div class="invalid-feedback text-start">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-wrapper">
                            <label for="gender">Jenis Kelamin</label>
                            <select name="gender" id="gender" class="form-control">
                                <option>Pilih Jenis Kelamin</option>
                                <option value="Male" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Female" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>                        
                        <div class="form-wrapper">
                            <label for="phone_number">Nomor HP</label>
                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" placeholder="ex. 087327882661" value="{{ old('phone_number') }}" required>
                            @error('phone_number')
                                <div class="invalid-feedback text-start">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="signin-btn">
                        Register
                    </button>
                    <p>Already have an account <a href="/login" class="text-decoration-none" style="color: #e0b973"><strong>Sign In</strong></a></p>
                </section>
            </form>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>