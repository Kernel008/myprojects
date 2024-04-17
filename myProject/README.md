<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Servis Tanıtımı</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2, p {
            color: #333;
            margin:5px;
        }
        
        h3{
        margin:0;
        }
        
        h4{
         font-weight:500;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .method {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .method.post {
            background-color: #5cb85c;
            color: #fff;
        }

        .method.get {
            background-color: #5bc0de;
            color: #fff;
        }

        .method.put {
            background-color: #f0ad4e;
            color: #fff;
        }

        .method.delete {
            background-color: #d9534f;
            color: #fff;
        }



    </style>
</head>
<body>
    <div class="container">
        <h1>BigCrunch Case</h1>
        <br>
        <div class="service">
            <h4>Bu API ile Kullanıcı, Blog ve Yorum yönetimi yapılmaktadır. Register ve Login sonrasındaki tüm servislerde Login servisinden alınan Token verisi Header içerisinde gönderilmelidir. Migration sonrası Kullanıcı, Blog, Yorum verileri eklendikten sonra diğer servislerle işlem sağlanabilir.</h4>
            <br><br>
            <p class="endpoint"><h3>Kullanıcı Kayıt</h3><br>
            <span class="method post">POST</span> /api/register</p>
            <p><strong>Parametreler:</strong> email, password, name</p>
            <br><br>
            <p class="endpoint"><h3>Kullanıcı Giriş</h3><br>
            <span class="method post">POST</span> /api/login</p>
            <p><strong>Parametreler:</strong> email, password</p>
            <br><br>
            <p class="endpoint"><h3>Blog Ekleme - Güncelleme</h3><br>
            <span class="method post">POST</span> /api/blog</p>
            <p><strong>Parametreler:</strong> title, content, category (opsiyonel)</p>
            <p><strong>Not:</strong> Kullanıcının aynı 'title' değeriyle bir blogu varsa veriler güncellenir.</p>
            <br><br>
            <p class="endpoint"><h3>Blog Silme</h3><br>
            <span class="method delete">DELETE</span> /api/blog</p>
            <p><strong>Parametreler:</strong> title</p>
            
            <br><br>
            <p class="endpoint"><h3>Blog Listeleme</h3><br>
            <span class="method get">GET</span> /api/blog</p>
            <p><strong>Parametreler:</strong> title (opsiyonel), category (opsiyonel)</p>
             <p><strong>Not:</strong> 'title' ve 'category' parametreleri gönderilirse bloglar filtrelenir, gönderilmezse kullanıcının tüm blogları listelenir.</p>
             <br><br>
            <p class="endpoint"><h3>Yorum Ekleme</h3><br>
            <span class="method post">POST</span> /api/comment</p>
            <p><strong>Parametreler:</strong> blogId, comment</p>
            <br><br>
            <p class="endpoint"><h3>Yorum Listeleme</h3><br>
            <span class="method get">GET</span> /api/comment</p>
            <p><strong>Parametreler:</strong> blogId</p>
           <p><strong>Not:</strong> 'blogId' parametresi gönderilirse ilgili blogun yorumları listelenir, gönderilmezse tüm yorumlar listelenir.</p>

        </div>
        <br><br>
        <h4><strong>Genel Yorumlar</strong></h4>
        <ul>
        <li>Projenin Frontend tarafı olmadığı için ayrımın daha anlaşılabilir olması adına blog işlemleri "id" değeri yerine "title" ile yapılmıştır. Canlı bir projede tüm işlemler "id" üzerinden yapılmalıdır.</li>
		<li>Projeyi yetiştirebilmek adına Etiket özelliğini es geçmek durumunda kaldım fakat kategori ile benzer bir şekilde eklenebilir. İstenirse eklenen etiketler tek bir sütunda virgül ile birleştirilip veri çekerken "LIKE %,mutfak,%" benzeri bir sorgulama yapılabilir. </li>
        <ul>
    </div>
</body>
</html>
