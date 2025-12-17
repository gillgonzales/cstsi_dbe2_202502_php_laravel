/* eslint-disable react/prop-types */
import { Link } from "react-router";
import { CardContainer, CardImage, CardMain, CardVideo } from "./card.styled";
import thumbImage from "../../assets/img/cards-thumbnail.jpg"

export const Cards = ({ item }) => {
    const srcImage = item?.media?.length ? item.media[0] : thumbImage;
    const isVideo = srcImage?.toLowerCase().includes('youtub')
    const srcVideo = isVideo ? srcImage.replace('https://www.youtube.com/watch?v=', 'https://www.youtube.com/embed/') : ''
    console.log(isVideo)
    return (
        <CardContainer>
            <Link to={`/produto/${item.id}`}>
                <CardMain>
                    <h3>{item.nome}</h3>
                    {!isVideo ?
                        <CardImage>
                            <img src={srcImage} />
                        </CardImage>
                        : <CardVideo>
                            <iframe
                            src={srcVideo}
                            title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer;
                                    autoplay;
                                    clipboard-write;
                                    encrypted-media;
                                    gyroscope;
                                    picture-in-picture;
                                    web-share"
                            referrerPolicy="strict-origin-when-cross-origin"
                            allowfullscreen />
                        </CardVideo>
                    }
                    <h4>
                        R$ {item.preco}
                    </h4>
                    <p>
                        {item.descricao}
                    </p>
                </CardMain>
            </Link>
        </CardContainer>
    );
};
