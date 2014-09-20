Select
  pages.Nom As NomPage,
  Concat(sites.URL, pages.URL) As URL,
  pages.Params,
  pages.Encre,
  categorie2site.IdSite,
  categorie2site.IdCategorie,
  categorie.Nom As NomCateg,
  pages.Id,
  pages.IdSite As IdSite1
From
  pages Inner Join
  page4user On pages.Id = page4user.IdPage Inner Join
  categorie2site On categorie2site.IdSite = pages.Id Inner Join
  categorie On categorie.Id = categorie2site.IdCategorie Inner Join
  sites On pages.IdSite = sites.Id
Where
  (page4user.IdUtilisateur = 1) Or
  (page4user.IdUtilisateur = 3)
Order By
  pages.Id
