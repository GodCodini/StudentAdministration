SELECT Kunde.*, (RechnungPos.RgPos_menge * RechnungPosition.RgPos_Preis)
FROM Rechnung
AS Umsatz
FROM Kunde
LEFT JOIN `rechnung` on Rg_KdId = kd_id
LEFT JOIN RechnungPosition on Rechnung.Rg_id = RechnungPosition.RgPos_id
ORDER BY Umsatz DESC