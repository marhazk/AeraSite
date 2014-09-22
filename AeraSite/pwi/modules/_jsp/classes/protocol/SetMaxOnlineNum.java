/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Manager;
/*    */ import com.goldhuman.IO.Protocol.Protocol;
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Session;
/*    */ 
/*    */ public final class SetMaxOnlineNum extends Protocol
/*    */ {
/*    */   public int maxnum;
/*    */   public int fake_maxnum;
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 19 */     os.marshal(this.maxnum);
/* 20 */     os.marshal(this.fake_maxnum);
/* 21 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 26 */     this.maxnum = os.unmarshal_int();
/* 27 */     this.fake_maxnum = os.unmarshal_int();
/* 28 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 35 */       return (SetMaxOnlineNum)super.clone();
/*    */     }
/*    */     catch (Exception e) {
/*    */     }
/* 39 */     return null;
/*    */   }
/*    */ 
/*    */   public void Process(Manager manager, Session session)
/*    */     throws ProtocolException
/*    */   {
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.SetMaxOnlineNum
 * JD-Core Version:    0.6.2
 */