explain select P.ean, count(nif)
from produto P, fornece_sec F
where P.ean = F.ean
group by P.ean;