$stores = @(
    "Cert:\LocalMachine\Root",
    "Cert:\LocalMachine\CA",
    "Cert:\LocalMachine\TrustedPublisher",
    "Cert:\CurrentUser\Root",
    "Cert:\CurrentUser\CA"
)

$found = @()
foreach ($store in $stores) {
    try {
        $hits = Get-ChildItem $store -ErrorAction Stop | Where-Object { $_.Subject -like '*AVG*' }
        foreach ($h in $hits) {
            $found += [PSCustomObject]@{ Store = $store; Thumb = $h.Thumbprint; Subject = $h.Subject }
        }
    } catch {
        Write-Output "ERR ${store}: $($_.Exception.Message)"
    }
}

if ($found.Count -eq 0) { Write-Output "NONE FOUND"; exit 1 }
$found | Format-List

$cert = Get-ChildItem $found[0].Store | Where-Object { $_.Thumbprint -eq $found[0].Thumb } | Select-Object -First 1
$bytes = $cert.Export([System.Security.Cryptography.X509Certificates.X509ContentType]::Cert)
$b64 = [Convert]::ToBase64String($bytes, 'InsertLineBreaks')
$pem = "-----BEGIN CERTIFICATE-----`r`n$b64`r`n-----END CERTIFICATE-----`r`n"
Add-Content -Path "C:\laragon\etc\ssl\cacert.pem" -Value $pem -Encoding ASCII
Write-Output "APPENDED from $($found[0].Store)"
Write-Output "Bundle size now: $((Get-Item 'C:\laragon\etc\ssl\cacert.pem').Length) bytes"
