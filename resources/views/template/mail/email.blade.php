<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            width: 80%;
            text-align: center;
            margin: 0 0;
            border: 1px solid black;
            height: fit-content;
        }

        header {
            background-color: #64D8CB;
            padding: 30px 100px;
            margin-bottom: 50px;
        }

        h1 {
            color: black;
        }

        p {
            font-size: 18px;
            color: black;
            margin: 30px auto;
            font-weight: 500;
        }

        span {
            font-weight: 800;
        }

        a {
            font-size: 18px;
            margin: 0 auto !important;
        }

        footer {
            background-color: #fafafa;
            margin-top: 50px;
            padding: 20px;
        }

        @media screen and (max-width: 990px) {
            body {
                font-family: Arial, Helvetica, sans-serif;
                width: 80%;
                text-align: center;
                margin: 0 0;
                border: 1px solid black;
                height: fit-content;
            }

            header {
                background-color: #64D8CB;
                padding: 10px 10px;
                margin-bottom: 40px;
            }

            h1 {
                color: black;
                font-size: 20px;
            }

            p {
                font-size: 14px;
                color: black;
                margin: 30px auto;
                font-weight: 500;
            }

            span {
                font-weight: 600;
            }

            a {
                font-size: 14px;
                margin: 0 auto !important;
            }

            footer {
                background-color: #fafafa;
                margin-top: 30px;
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <header>
        @if($email_data['type'] == 'verifikasi')
        <h1 align="center">KONFIRMASI EMAIL CERTIFFET</h1>
        @elseif($email_data['type'] == 'register')
        <h1 align="center">PENDAFTARAN BERHASIL</h1>
        @else
        <h1 align="center">SERTIFIKAT {{ $email_data['event']}}</h1>
        @endif
    </header>
    <main>
        @if($email_data['type'] == 'verifikasi')
        <p align="center">Selamat datang <span>{{ $email_data['name'] }}</span></p>
        <p align="center">Untuk mulai menggunakan website Certiffet tolong validasi email anda dengan menekan link
            berikut</p>
        <div style="text-align:center">
            <a href="{{route('verify_account', $email_data['api_key'] )}}">Konfirmasi email anda disini</a>
        </div>
        @elseif($email_data['type'] == 'register')
        <p align="center">Selamat <span>{{ $email_data['name'] }}</span></p>
        <p align="center">Anda telah terdaftar di event {{ $email_data['event_name']}}</p>
        <p align="center">yang akan diselenggarakan oleh {{ $email_data['instansi']}}</p>
        <p align="center"> pada tanggal {{ $email_data['date'] }}</p>

        @else
        <p align="center">Selamat <span>{{ $email_data['name'] }}</span></p>
        <p align="center">Anda mendapat sertifikat karena telah menyelesaikan event {{ $email_data['event'] }}.</p>
        <p align="center">{{ $email_data['congrat_word'] }}</p>
        <a href="">
            <p align="center">ID SERTIFIKAT : #{{ $email_data['idpeserta'] }}</p>
        </a>
        <p align="center">Anda dapat mengunduh sertifikat di {{ route('landing-page') }}.</p>
        @endif
    </main>
</body>
<footer>
    <p align="center">Hubungi kami di certiffet@gmail.com jika mengalami kendala.</p>
</footer>

</html>
