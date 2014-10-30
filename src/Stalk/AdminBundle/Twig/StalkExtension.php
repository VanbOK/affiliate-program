<?php 

namespace Stalk\AdminBundle\Twig;

class StalkExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('pathinfo', array($this, 'pathinfo')),
            new \Twig_SimpleFilter('youtubeId', array($this, 'getYoutubeVideoId')),
            new \Twig_SimpleFilter('rus_val', array($this, 'getRusValByKey')),
        );
    }

    /*
     * Get pathinfo
     */
    public static function pathinfo($url, $options)
    {       
        
        $path = pathinfo($url);
        
        switch ($options) {
            case 'dirname':
                return $path['dirname'];
                break;
            case 'basename':
                return $path['basename'];
                break;
            case 'extension':
                return $path['extension'];
                break;
            case 'filename':
                return $path['filename'];
                break;
            default:
                return '';
                break;
        }        
        
    }
    
    /*
     * Get youtube video Id
     */
    public static function getYoutubeVideoId($url)
    {       
        
        $video_id = false;
        $url = parse_url($url);
        
        if (empty($url['host']))
            return false;
        
        if (strcasecmp($url['host'], 'youtu.be') === 0) {
            
            #### (dontcare)://youtu.be/<video id>
            $video_id = substr($url['path'], 1);
            
        } elseif (strcasecmp($url['host'], 'www.youtube.com') === 0) {
            
            if (isset($url['query'])) {
                
                parse_str($url['query'], $url['query']);
                
                if (isset($url['query']['v'])) {
                    #### (dontcare)://www.youtube.com/(dontcare)?v=<video id>
                    $video_id = $url['query']['v'];
                }
                
            }
            
            if ($video_id == false) {
                
                $url['path'] = explode('/', substr($url['path'], 1));
                
                if (in_array($url['path'][0], array('e', 'embed', 'v'))) {
                    #### (dontcare)://www.youtube.com/(whitelist)/<video id>
                    $video_id = $url['path'][1];
                }
                
            }
            
        }
        
        return $video_id;   
        
    }
    
    /*
     * Get Russian value by key
     */
    public static function getRusValByKey($key)
    {       
        
        $arr = array(
            //Статус
            'notConfirmed' => 'не подтверждён',
            'active' => 'активен',
            //Статус дохода
            'expected' => 'ожидается',
            'payment' => 'выплата',
            'paid' => 'выплачено',
        );     
        
        if (!empty($arr[$key]))      
            return $arr[$key];
        
    }

    public function getName()
    {
        return 'stalk_extension';
    }
    
}