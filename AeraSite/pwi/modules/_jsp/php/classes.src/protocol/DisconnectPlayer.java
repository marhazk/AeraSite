/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Manager;
/*    */ import com.goldhuman.IO.Protocol.Protocol;
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Session;
/*    */ 
/*    */ public final class DisconnectPlayer extends Protocol
/*    */ {
/*    */   public int roleid;
/*    */   public int provider_link_id;
/*    */   public int localsid;
/*    */   public int gameid;
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 21 */     os.marshal(this.roleid);
/* 22 */     os.marshal(this.provider_link_id);
/* 23 */     os.marshal(this.localsid);
/* 24 */     os.marshal(this.gameid);
/* 25 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 30 */     this.roleid = os.unmarshal_int();
/* 31 */     this.provider_link_id = os.unmarshal_int();
/* 32 */     this.localsid = os.unmarshal_int();
/* 33 */     this.gameid = os.unmarshal_int();
/* 34 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 41 */       return (DisconnectPlayer)super.clone();
/*    */     }
/*    */     catch (Exception e) {
/*    */     }
/* 45 */     return null;
/*    */   }
/*    */ 
/*    */   public void Process(Manager manager, Session session)
/*    */     throws ProtocolException
/*    */   {
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.DisconnectPlayer
 * JD-Core Version:    0.6.2
 */