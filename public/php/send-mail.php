<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Solo aceptar POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

// Leer JSON del body
$data = json_decode(file_get_contents('php://input'), true);

$name = htmlspecialchars(trim($data['name'] ?? ''));
$email = htmlspecialchars(trim($data['email'] ?? ''));
$phone = htmlspecialchars(trim($data['phone'] ?? ''));
$message = htmlspecialchars(trim($data['message'] ?? ''));

// Validación básica
if (!$name || !$email || !$message) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Faltan campos requeridos']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Email inválido']);
    exit;
}

// Cargar PHPMailer
require_once __DIR__ . '/PHPMailer/src/Exception.php';
require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    // Configuración SMTP de GoDaddy
    $mail->isSMTP();
    $mail->Host = 'mail.clusterciim.org'; // SMTP de GoDaddy
    $mail->SMTPAuth = true;
    $mail->Username = 'no-reply@clusterciim.org';
    $mail->Password = 'Acceso2026#'; // ← Cambia esto
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;
    $mail->CharSet = 'UTF-8';

    // Remitente y destinatario
    $mail->setFrom('no-reply@clusterciim.org', 'CCIIM - Web');
    $mail->addAddress('info@clusterciim.org', 'CCIIM');
    $mail->addReplyTo($email, $name); // Para responder directo al visitante

    // Contenido
    $mail->isHTML(true);
    $mail->Subject = "Nuevo mensaje de contacto de $name";    $mail->Body = "
<!DOCTYPE html>
<html>
<body style='margin:0; padding:0; background:#f5f5f5; font-family:-apple-system,BlinkMacSystemFont,\"Segoe UI\",sans-serif;'>
  <div style='max-width:560px; margin:2rem auto; background:#ffffff; border:0.5px solid #e0e0e0; border-radius:4px; overflow:hidden;'>
    
    <div style='padding:2rem 2.5rem 1.5rem; border-bottom:0.5px solid #e8e8e8;'>
      <img src='https://clusterciim.org/Logo/logo.webp' alt='CCIIM' style='height:36px; display:block;' />
    </div>

    <div style='padding:2rem 2.5rem;'>
      <p style='font-size:11px; letter-spacing:0.08em; color:#999; text-transform:uppercase; margin:0 0 0.5rem;'>Nuevo mensaje de contacto</p>
      <h1 style='font-size:20px; font-weight:500; color:#111; margin:0 0 1.75rem;'>Tienes un nuevo mensaje</h1>

      <div style='border:0.5px solid #e8e8e8; border-radius:4px; overflow:hidden; margin-bottom:1.75rem;'>
        <div style='display:flex; border-bottom:0.5px solid #e8e8e8;'>
          <div style='width:100px; padding:12px 16px; background:#fafafa; font-size:12px; color:#999; font-weight:500; text-transform:uppercase; letter-spacing:0.04em;'>Nombre</div>
          <div style='padding:12px 16px; font-size:14px; color:#111;'>$name</div>
        </div>
        <div style='display:flex; border-bottom:0.5px solid #e8e8e8;'>
          <div style='width:100px; padding:12px 16px; background:#fafafa; font-size:12px; color:#999; font-weight:500; text-transform:uppercase; letter-spacing:0.04em;'>Email</div>
          <div style='padding:12px 16px; font-size:14px; color:#111;'>$email</div>
        </div>
        <div style='display:flex; border-bottom:0.5px solid #e8e8e8;'>
          <div style='width:100px; padding:12px 16px; background:#fafafa; font-size:12px; color:#999; font-weight:500; text-transform:uppercase; letter-spacing:0.04em;'>Teléfono</div>
          <div style='padding:12px 16px; font-size:14px; color:#111;'>$phone</div>
        </div>
        <div style='display:flex;'>
          <div style='width:100px; padding:12px 16px; background:#fafafa; font-size:12px; color:#999; font-weight:500; text-transform:uppercase; letter-spacing:0.04em;'>Mensaje</div>
          <div style='padding:12px 16px; font-size:14px; color:#333; line-height:1.6;'>$message</div>
        </div>
      </div>

      <a href='mailto:$email' style='display:inline-block; background:#111; color:#fff; text-decoration:none; font-size:13px; font-weight:500; padding:10px 20px; border-radius:2px;'>Responder a $name</a>
    </div>

    <div style='padding:1.25rem 2.5rem; border-top:0.5px solid #e8e8e8;'>
      <p style='font-size:11px; color:#bbb; margin:0;'>Este mensaje fue enviado desde el formulario de contacto en clusterciim.org</p>
    </div>
  </div>
</body>
</html>
";
    $mail->AltBody = "Nombre: $name\nEmail: $email\nTeléfono: $phone\nMensaje: $message";

    $mail->send();
    echo json_encode(['success' => true, 'message' => 'Mensaje enviado correctamente']);

}
catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error al enviar: ' . $mail->ErrorInfo
    ]);
}