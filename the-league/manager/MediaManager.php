<?php
class MediaManager extends AbstractManager
{
    public function create(Media $media) : Media
    {
        $query = $this->db->prepare("INSERT INTO media(url, alt) VALUES(:url, :alt);");
        $parameters = [
            "url" => $media->getUrl(),
            "alt" => $media->getalt()
        ];

        $query->execute($parameters);
        return $media;
    }

    public function update(Media $media): Media
    {
        $query = $this->db->prepare("UPDATE media SET url = :url, alt = :alt WHERE id = :id");
        $parameters = [
            "url"=> $media->getUrl(),
            "alt"=> $media->getAlt(),
            "id"=> $media->getId()
        ];

        $query->execute($parameters);
        return $media;
    }

    public function delete(Media $media): void
    {
        $query = $this->db->prepare("DELETE FROM media WHERE id = :id");
        $parameters = [
            "id"=> $media->getId(),
        ];

        $query->execute($parameters);
    }

    public function findOne(int $id): ?Media
    {
        $query = $this->db->prepare("SELECT * FROM media WHERE id = :id");
        $parameters = [
            "id"=> $id,
        ];

        $query->execute($parameters);
        $result = $query->fetch(\PDO::FETCH_ASSOC);

        if (isset($result))
        {
            return new Media($result["url"], $result["alt"] ,$result["id"]);
        }

        else
        {
            return null;
        }
    }

    public function findAll(): array
    {
        $query = $this->db->prepare("SELECT * FROM media");
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        $tab = [];

        foreach ($result as $media)
        {
            $tab[] = new Media($media["url"], $media["alt"], $media["id"]);
        }

        return $tab;
    }
}